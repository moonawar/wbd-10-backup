const usernameInput = document.getElementById('username');
const usernameMsg = document.getElementById('username-msg');

let debounceTimer;

usernameInput.addEventListener('input', function() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(function() {
        checkUsernameAvail(usernameInput.value);
    }, 500);
});

function checkUsernameAvail(username) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `/user/exists?username=${username}`);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            console.log();
            if (response.exists) {
                usernameMsg.innerHTML = 'Username already taken';
            } else {
                usernameMsg.innerHTML = '';
            }
        }
    };

    xhr.send();
}