document.getElementById('registerForm').addEventListener('submit-btn', function (e) {
    e.preventDefault();
    var username = document.getElementById('username').value;

    axios.get(`/check-username/${username}`)
        .then(function (response) {
            if (response.data.exists) {
                document.getElementById('errorMessage');
            } else {
                document.getElementById('registerForm').submit();
            }
        })
        .catch(function (error) {
            console.error(error);
        });
});