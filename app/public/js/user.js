function checkUsernameAvail(username) {
    var xhr = new XMLHttpRequest();
    xhr.callback = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.exist) {
                alert('Username already exists!');
            }
        }
    }

    xhr.open('GET', '/api/users/exist?username='+ username, true);    
}