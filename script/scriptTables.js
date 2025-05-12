$(document).ready(function () {
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    const editForm = document.getElementById('editForm');
    const modalBody = document.getElementById('editModalBody');
    let isAddMode = false;

    // Add Button
    $(document).on('click', '.addBtn', async function () {
        console.log("asdas")
        isAddMode = true;
        const page = $("#currentPage").val();
        modalBody.innerHTML = '';
        document.getElementById('edit-id').value = '';

        if (page === 'users.php') {
            const sessionRole = parseInt($("#sessionRole").val());

            modalBody.innerHTML += `
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="first_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Profile Image</label>
                    <input type="file" class="form-control" name="profile_image" accept="image/*" required>
                </div>`;

            const roleOptions = sessionRole == 1
                ? `<option value="2">Admin</option><option value="3">User</option>`
                : `<option value="3">User</option>`;

            modalBody.innerHTML += `
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select class="form-select" name="role_id" required>
                        ${roleOptions}
                    </select>
                </div>`;
        }

        if (page === 'genres.php') {
            modalBody.innerHTML += `
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>`;
        }

        if (page === 'movies.php') {
            const genreResponse = await $.get('/NumberCircled/app/controller/fetch/fetch_options.php?type=genres');

            modalBody.innerHTML += `
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Release Date</label>
                        <input type="number" class="form-control" name="release_date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image URL</label>
                        <input type="text" class="form-control" name="image_url" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Genres</label>
                        <div id="genre-container" class="d-flex flex-wrap gap-2 mb-2"></div>
                        <select id="genre-select" class="form-select">
                            <option value="">Select Genre</option>
                            ${genreResponse.map(g => `<option value="${g.id}">${g.name}</option>`).join('')}
                        </select>
                    </div>`;


            setTimeout(() => {
                $('#genre-container').html('');
            }, 0);
        }
        $('#editModalLabel').text(isAddMode ? 'Add Record' : 'Edit Record');
        $('#modal-submit-btn').text(isAddMode ? 'Add Record' : 'Save Changes');
        editModal.show();
    });
    // Edit Button
    $(document).on('click', '.editBtn', async function () {
        isAddMode = false;
        const button = this;
        const page = $("#currentPage").val();
        const dataAttrs = [...button.attributes].filter(attr => attr.name.startsWith('data-'));
        modalBody.innerHTML = '';
        document.getElementById('edit-id').value = '';

        const genreResponse = await $.get('/NumberCircled/app/controller/fetch/fetch_options.php?type=genres');
        const allGenres = genreResponse;
        let selectedGenres = [];

        // USERS
        if (page === 'users.php') {
            const sessionRole = parseInt($("#sessionRole").val());
            const sessionUserId = parseInt($("#sessionUserId").val());

            let userData = {};
            dataAttrs.forEach(attr => {
                const key = attr.name.replace('data-', '');
                userData[key] = attr.value;
                if (key === 'id') document.getElementById('edit-id').value = attr.value;
            });
            console.log(userData)

            const isSelf = parseInt(userData.id) === sessionUserId;

            // First Name, Last Name, Email
            modalBody.innerHTML += `
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" value="${userData.first_name}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" value="${userData.last_name}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="${userData.email}" required>
        </div>`;

            // Role Selector
            let roleField = '';
            if ((sessionRole === 1 && isSelf) || (sessionRole === 2 && isSelf)) {
                // Super Admin or Admin editing themselves
                const roleName = sessionRole == 1 ? 'Super Admin' : (sessionRole == 2 ? 'Admin' : 'User');
                roleField = `
            <div class="mb-3">
                <label class="form-label">Role</label>
                <input type="text" class="form-control" value="${roleName}" disabled>
                <input type="hidden" name="role_id" value="${sessionRole}">
            </div>`;
            } else {
                // Super Admin editing someone else or Admin editing a user
                const options = sessionRole == 1
                    ? `<option value="2" ${userData.role_id == 2 ? 'selected' : ''}>Admin</option>
                   <option value="3" ${userData.role_id == 3 ? 'selected' : ''}>User</option>`
                    : `<option value="3" selected>User</option>`;

                roleField = `
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select class="form-select" name="role_id" required>
                    ${options}
                </select>
            </div>`;
            }

            modalBody.innerHTML += roleField;

            // Profile image input
            modalBody.innerHTML += `
        <div class="mb-3">
            <label class="form-label">Profile Image</label>
            <input type="file" class="form-control" name="profile_image" accept="image/*">
        </div>`;
        }

        // MOVIES
        else if (page === 'movies.php') {
            let movieData = {};
            dataAttrs.forEach(attr => {
                const key = attr.name.replace('data-', '');
                movieData[key] = attr.value;
                if (key === 'id') document.getElementById('edit-id').value = attr.value;
            });

            modalBody.innerHTML += `
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="${movieData.name}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" required>${movieData.description}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Release Date</label>
            <input type="number" class="form-control" name="release_date" value="${movieData.release_date}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Image URL</label>
            <input type="text" class="form-control" name="image_url" value="${movieData.image_url}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Genres</label>
            <div id="genre-container" class="d-flex flex-wrap gap-2 mb-2"></div>
            <select id="genre-select" class="form-select">
                <option value="">Select Genre</option>
                ${allGenres.map(g => `<option value="${g.id}">${g.name}</option>`).join('')}
            </select>
        </div>`;

            if (movieData.genres) {
                selectedGenres = movieData.genres.split(',').map(g => g.trim());
                setTimeout(() => {
                    selectedGenres.forEach(g => {
                        const matched = allGenres.find(genre => genre.name === g);
                        if (matched) addGenreTag(matched.id, matched.name);
                    });
                }, 0);
            }
        }

        // GENRES
        else if (page === 'genres.php') {
            dataAttrs.forEach(attr => {
                const key = attr.name.replace('data-', '');
                if (key === 'id') {
                    document.getElementById('edit-id').value = attr.value;
                    return;
                }
                const label = key.replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());
                modalBody.innerHTML += `
            <div class="mb-3">
                <label class="form-label">${label}</label>
                <input type="text" class="form-control" name="${key}" value="${attr.value}" required>
            </div>`;
            });
        }

        $('#editModalLabel').text('Edit Record');
        $('#modal-submit-btn').text('Save Changes');
        editModal.show();
    });


    // Genre tag logic
    $(document).on('change', '#genre-select', function () {
        const genreId = $(this).val();
        const genreName = $(this).find('option:selected').text();
        if (genreId && !$(`input[name='genre_ids[]'][value='${genreId}']`).length) {
            addGenreTag(genreId, genreName);
        }
        $(this).val('');
    });

    function addGenreTag(id, name) {
        $('#genre-container').append(`
            <span class="badge bg-primary p-2">
                ${name}
                <button type="button" class="btn-close btn-close-white btn-sm ms-2 remove-genre" data-id="${id}" aria-label="Remove"></button>
                <input type="hidden" name="genre_ids[]" value="${id}">
            </span>
        `);
    }

    $(document).on('click', '.remove-genre', function () {
        $(this).closest('span').remove();
    });

    editForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(editForm);
        const page = $("#currentPage").val();

        formData.append('page', page); // Always send the page
        if (!isAddMode) {
            formData.append('last_edited_at', new Date().toISOString().slice(0, 19).replace('T', ' '));
        }

        fetch('/NumberCircled/app/controller/edit.php', {
            method: 'POST',
            body: formData
        })
            .then(res => res.text())
            .then(response => {
                alert(response);
                editModal.hide();
                loadTables();
            })
            .catch(err => console.error(err));
    });


    // Delete Button
    $(document).on("click", ".deleteBtn", function () {
        $.post("../../controller/delete.php", {
            id: $(this).data("id"),
            page: $("#currentPage").val()
        }, function (data) {
            alert(data);
            loadTables();
        });
    });

    // Load tables
    function loadTables() {
        if ($.fn.DataTable.isDataTable('#table')) {
            $('#table').DataTable().clear().destroy();
        }

        $.get("/NumberCircled/app/controller/fetch/fetch.php", { page: $("#currentPage").val() }, function (data) {
            $('#tableLoad').html(data);
            $('#table').DataTable({
                paging: true,
                info: true,
                searching: true,
                ordering: true
            });
        });
    }

    // Initial table load
    loadTables();

    function addSentimentFilter() {
        const sentimentFilter = `
        <label class="ms-2">
            Filter by Sentiment: 
            <select id="sentimentFilter" class="form-select form-select-sm d-inline w-auto ms-2">
                <option value="">All</option>
                <option value="Positive">Positive</option>
                <option value="Neutral">Neutral</option>
                <option value="Negative">Negative</option>
            </select>
        </label>`;
        $('#table_filter').append(sentimentFilter);

        $('#sentimentFilter').on('change', function () {
            $('#table').DataTable().column(8).search(this.value).draw(); // adjust index if needed
        });
    }
    const page = $("#currentPage").val();
    if (page === "reviews.php") {
        setTimeout(addSentimentFilter, 500); // wait for table to render
    }
});
