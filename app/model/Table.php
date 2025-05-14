<?php
require_once __DIR__ . "/../../config/database.php";

class Table
{
    // Get all reviews
    function getAllReviews()
    {
        global $conn;
        $query = "
            SELECT 
                r.id AS id,
                CONCAT(u.first_name, ' ', u.last_name) AS user_name,
                u.email AS user_email,
                m.name AS movie_name,
                m.id AS movie_id,
                r.comment,
                r.rating,
                r.score,
                CASE 
                WHEN r.score > 0.5 THEN 'Positive'
                WHEN r.score = 0.5 THEN 'Neutral'
                ELSE 'Negative'
            END AS sentiment,
                r.created_at,
                r.last_edited_at
            FROM reviews AS r
            INNER JOIN users AS u ON r.user_id = u.id
            INNER JOIN movies AS m ON r.movie_id = m.id;
        ";
        return $conn->query($query);
    }

    // Get all users
    function getAllUsers()
    {
        global $conn;
        $query = "
            SELECT 
                u.id,
                r.role AS user_role,
                u.first_name,
                u.last_name,
                u.email,
                u.profile_image,
                u.created_at,
                u.last_edited_at
            FROM users as u
            INNER JOIN roles as r ON u.role_id = r.id;
        ";
        return $conn->query($query);
    }

    // Get all movies
    function getAllMovies()
    {
        global $conn;
        $query = "
                SELECT 
                    m.id, 
                    m.name, 
                    m.description, 
                    GROUP_CONCAT(g.name ORDER BY g.name SEPARATOR ', ') AS genres,
                    m.release_date, 
                    m.image_url,
                    m.created_at,
                    m.last_edited_at
                FROM movies AS m
                LEFT JOIN movie_genres AS mg ON mg.movie_id = m.id
                LEFT JOIN genres AS g ON mg.genre_id = g.id
                GROUP BY m.id;

        ";
        return $conn->query($query);
    }

    // Get all genres
    function getAllGenres()
    {
        global $conn;
        $query = "
            SELECT 
                g.id, 
                g.name
            FROM genres AS g;
        ";
        return $conn->query($query);
    }

    function deleteReview($id)
    {
        global $conn;
        $query = "DELETE FROM reviews WHERE id = '$id'";
        return $conn->query($query);
    }
    function deleteUser($id)
    {
        global $conn;
        $query = "DELETE FROM users WHERE id = '$id'";
        return $conn->query($query);
    }
    function deleteMovie($id)
    {
        global $conn;
        $query = "DELETE FROM movies WHERE id = '$id'";
        return $conn->query($query);
    }
    function deleteGenre($id)
    {
        global $conn;
        $query = "DELETE FROM genres WHERE id = '$id'";
        return $conn->query($query);
    }

    function getGenres()
    {
        global $conn;
        $sql = "SELECT id, name FROM genres";
        return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public function getMovies()
    {
        global $conn;
        $sql = "SELECT id, name FROM movies ORDER BY name ASC";
        return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    function getMovieById($id)
    {
        global $conn;
        $query = "SELECT * FROM movies WHERE id = '$id'";
        return $conn->query($query);
    }

    function addUser($role_id, $first_name, $last_name, $email, $password, $profile_image = null)
    {
        global $conn;

        $check = $conn->query("SELECT id FROM users WHERE email = '$email'");
        if ($check->num_rows > 0) return "Email already exists.";

        $hashed_password = md5($password);

        if ($profile_image) {
            $stmt = $conn->prepare("INSERT INTO users (role_id, first_name, last_name, email, password, profile_image) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('isssss', $role_id, $first_name, $last_name, $email, $hashed_password, $profile_image);
        } else {
            $default_image = file_get_contents(__DIR__ . '/../../assets/default-profile.jpeg');
            $stmt = $conn->prepare("INSERT INTO users (role_id, first_name, last_name, email, password, profile_image) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('isssss', $role_id, $first_name, $last_name, $email, $hashed_password, $default_image);
        }
        return $stmt->execute();
        // return $conn->insert_id;
    }

    function addGenre($name)
    {
        global $conn;
        $check = $conn->query("SELECT id FROM genres WHERE name = '$name'");
        if ($check->num_rows > 0) return "Genre already exists.";

        $stmt = $conn->prepare("INSERT INTO genres (name) VALUES (?)");
        $stmt->bind_param('s', $name);
        return $stmt->execute();
    }

    function addMovie($name, $description, $release_date, $image_url)
    {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO movies (name, description, release_date, image_url) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('ssss', $name, $description, $release_date, $image_url);
        return $stmt->execute();
    }

    function addMovieGenres($movieId, $genreIds)
    {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO movie_genres (movie_id, genre_id) VALUES (?, ?)");
        foreach ($genreIds as $genreId) {
            $stmt->bind_param("ii", $movieId, $genreId);
            $stmt->execute();
        }
    }

    function updateGenre($id, $data)
    {
        global $conn;
        $stmt = $conn->prepare("UPDATE genres SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $data['name'], $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    function updateUser($id, $data, $profileImageData = null)
    {
        global $conn;

        if ($profileImageData !== null) {
            $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, role_id = ?, profile_image = ?, last_edited_at = NOW() WHERE id = ?");
            $stmt->bind_param("sssisi", $data['first_name'], $data['last_name'], $data['email'], $data['role_id'], $profileImageData, $id);
        } else {
            $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, role_id = ?, last_edited_at = NOW() WHERE id = ?");
            $stmt->bind_param("sssii", $data['first_name'], $data['last_name'], $data['email'], $data['role_id'], $id);
        }

        return $stmt->execute();
    }


    function updateMovie($id, $data)
    {
        global $conn;
        $stmt = $conn->prepare("UPDATE movies SET name = ?, description = ?, release_date = ?, image_url = ?, last_edited_at = NOW() WHERE id = ?");
        $stmt->bind_param("ssssi", $data['name'], $data['description'], $data['release_date'], $data['image_url'], $id);
        $result = $stmt->execute();
        $stmt->close();

        if (isset($data['genre_ids']) && is_array($data['genre_ids'])) {
            $delStmt = $conn->prepare("DELETE FROM movie_genres WHERE movie_id = ?");
            $delStmt->bind_param("i", $id);
            $delStmt->execute();
            $delStmt->close();

            $insStmt = $conn->prepare("INSERT INTO movie_genres (movie_id, genre_id) VALUES (?, ?)");
            foreach ($data['genre_ids'] as $genreId) {
                $insStmt->bind_param("ii", $id, $genreId);
                $insStmt->execute();
            }
            $insStmt->close();
        }

        return $result;
    }
}
