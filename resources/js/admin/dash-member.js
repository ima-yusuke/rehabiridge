import "flowbite";
const TOGGLE_INPUT = document.querySelectorAll('.toggleBtn');

for (let i = 0; i < TOGGLE_INPUT.length; i++) {
    TOGGLE_INPUT[i].addEventListener('change', function () {
        TogglePermission(TOGGLE_INPUT[i]);
    });
}
function TogglePermission(input) {

    let id = input.value;
    let is_enabled = input.checked ? 1 : 0; // チェックボックスがチェックされているかどうかでis_enabledを設定

    FetchData('/dashboard/toggle-permission', 'POST',true,JSON.stringify({ id: id, is_enabled: is_enabled }))
        .then(data => {
            alert(data.message);
            window.location.href = data.redirect;
        })
        .catch(error => {
            alert(error.message);
        });
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
