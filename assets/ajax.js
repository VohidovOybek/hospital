var myModal = new bootstrap.Modal(document.getElementById('userModal'), {
    keyboard: false
})

var userModalShow = new bootstrap.Modal(document.getElementById("userModalShow"));

function getUserList() {
    let userList;
    const ajax = new XMLHttpRequest();
    ajax.open('GET', '/json/data');
    ajax.send();
    ajax.onload = function () {
        userList = JSON.parse(ajax.response);
        if (userList) {

            let template = '';
            if (Array.isArray(userList)) {

                userList.forEach(function (user) {
                    template += `<tr id='id-${user.id}'>
                                    <td>${user.id}</td>
                                    <td>${user.name}</td>
                                    <td>${user.username}</td>
                                    <td>
                                        <img width="80" src='assets/${user.img_path}'>
                                    </td>
                                    <td>
                                        <button  class="btn btn-danger" onclick="deleteUser(${user.id})">🗑️ DELETE</button>
                                        <button  class="btn btn-warning" onclick="showUser(${user.id})">👀 SHOW</button>
                                    </td>
                                  </tr>`
                });
            }
            if (template) {
                let user_table = document.getElementById("users");
                if (user_table) {
                    user_table.innerHTML = template;
                }

            }
        }
    };

}

function deleteUser(userid) {
    let res = confirm("Вы уверены, что удалите этого пользователя");
    if (res) {
        const ajax = new XMLHttpRequest();
        ajax.open('POST', '/json/data/users-delete');
        let json = JSON.stringify({ // string
            user_id: userid,
        });
        ajax.send(json);
        ajax.onload = function () {
            let response = JSON.parse(ajax.response);
            if (response.status) {
                alert(response.message);
                let deleted_row = document.getElementById('id-' + userid);
                deleted_row.remove();
            }
        };
    } else {
        console.log("Delete canceled")
    }
}

let user_form = document.querySelector("#user_form");
user_form.onsubmit = function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    const ajax = new XMLHttpRequest();
    ajax.open('POST', '/json/data/users-create');
    ajax.send(formData);
    ajax.onload = function () {
        let response = JSON.parse(ajax.response);
        if (response.status) {
            alert(response.message);
            myModal.toggle();
        }
    };
}



function showUser(id){
    const ajax = new XMLHttpRequest();
    ajax.open('get', '/json/data/users-show?user_id=' + id);
    ajax.send();
    ajax.onload = function () {
        let response = JSON.parse(ajax.response);
        if (response.status) {
            console.log(response);
            let user_name = document.getElementById("user_name");
            let img  = document.getElementById("user_image");
            user_name.innerHTML = response.user.name;
            img.src = '/assets/' + response.user.img_path;
            console.log({img, user_name});
            userModalShow.toggle();
        }
    };
}

// setInterval(function () {
//     getUserList();
// }, 1000);