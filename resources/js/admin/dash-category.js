
const ADD_BUTTON = document.getElementById("add_category_btn");//新規登録ボタン
const EDIT_BUTTONS = document.querySelectorAll('.editBtn');//編集ボタン
const DELETE_BUTTONS = document.querySelectorAll('.deleteBtn');//削除ボタン
const FORM_ELEMENT = document.getElementById('post_form');//新規登録form

EDIT_BUTTONS.forEach((btn,idx) => {
    btn.addEventListener('click', function() {

        let selectedAccordion = btn.parentNode.parentNode.parentNode.nextElementSibling;//アコーディオン中身

        ToggleAccordion(selectedAccordion, btn);
    });
});

// アコーディオン開閉
function ToggleAccordion(selectedAccordion, btn) {
    if (selectedAccordion.classList.contains('visible')) {
        selectedAccordion.classList.remove('visible');
        btn.innerHTML = "<i class=\"fa-solid fa-plus\"></i>";
    } else {
        // すべてのアコーディオンを閉じる
        document.querySelectorAll('.qa__body').forEach(content => {
            content.classList.remove('visible');
        });

        // すべてのボタンのテキストをリセット
        EDIT_BUTTONS.forEach(button => {
            button.innerHTML = "<i class=\"fa-solid fa-plus\"></i>";
        });

        // 選択されたアコーディオンを開く
        selectedAccordion.classList.add('visible');
        btn.innerHTML = "<i class=\"fa-solid fa-minus\"></i>";
    }
}

//[ADD]投稿追加
if(ADD_BUTTON!==null){
    ADD_BUTTON.addEventListener('click', function() {
        const formData = new FormData(FORM_ELEMENT);
        const categoryInput = document.getElementById('new_category');

        // バリデーション
        if (categoryInput.value.trim() === "") {
            alert('カテゴリーを入力してください。');
            return;
        }

        FetchData('/dashboard/category', 'POST',null, formData)
            .then(data => {
                alert(data.message);
                window.location.href = data.redirect;
            })
            .catch(error => {
                alert(error.message);
            });
    });
}

//[DELETE]投稿削除
for (let i = 0; i < DELETE_BUTTONS.length; i++) {
    DELETE_BUTTONS[i].addEventListener('click', function () {
        DeletePost(DELETE_BUTTONS[i]);
    });
}

function DeletePost(btn) {
    let id = btn.getAttribute('data-post-id');

    // 確認ダイアログを表示し、ユーザーがOKを押した場合のみ削除処理を実行
    if (confirm('本当に削除しますか？')) {

        // Ajaxリクエストを送信して削除処理を行う
        FetchData('/dashboard/post', 'DELETE',true,JSON.stringify({ id: id }))
            .then(data => {
                alert(data.message);
                window.location.href = data.redirect;
            })
            .catch(error => {
                console.error('削除に失敗しました:', error);
            });
    }
}


function FetchData(url,method,headerData,bodyData) {

    const headers = {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };

    // headerDataがtrueであれば、既存のheadersにマージする
    if (headerData) {
        Object.assign(headers, {
            'Content-Type': 'application/json'
        });
    }

    return fetch(url, {
        method: method,
        headers: headers,
        body: bodyData
    })
        .then(response => {
            return response.json();
        })
        .catch(error => {
            console.error('Error:', error);
            throw new Error(error.message);
        });
}

