
// chọn tất cả
document.getElementById('select-all').addEventListener('change', function () {
    let checkboxes = document.querySelectorAll('.user-select-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
});

// nếu bỏ chọn 1 cái thì bỏ luôn select-all
document.querySelectorAll('.user-select-checkbox').forEach(cb => {
    cb.addEventListener('change', function () {
        let all = document.querySelectorAll('.user-select-checkbox');
        let checked = document.querySelectorAll('.user-select-checkbox:checked');

        document.getElementById('select-all').checked = all.length === checked.length;
    });
});


// Xử lý nút Edit, Delete, View
/* Delete item */
document.querySelectorAll('.delete-item').forEach(btn => {
    btn.addEventListener('click', function () {
        let id = this.dataset.id;
        let url = this.dataset.url;
        confirmDialog({
            action: 'delete-item',
            text: 'Bạn có chắc chắn muốn xóa mục này?',
            value: url + '/' + id,
            title: 'Thông báo',
            icon: 'warning'        });
    });
});

/* Edit item */
document.querySelectorAll('.edit-item-modal').forEach(btn => {
    btn.addEventListener('click', function () {
        let id = this.dataset.id;
        let url = this.dataset.url;

        let data = new FormData();
        data.append('id', id);

        fetch(url, {
            method: 'POST',
            headers: {
               'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: data
        })
        .then(res => res.json())
        .then(res => {
            // 👉 GÁN DATA VÀO FORM
            document.getElementById('userId').value = res.data.id;
            document.querySelector('[name="fullname"]').value = res.data.fullname;
            document.querySelector('[name="email"]').value = res.data.email;
            document.querySelector('[name="phone"]').value = res.data.phone ?? '';
            document.querySelector('[name="address"]').value = res.data.address ?? '';
            document.querySelector('[name="role"]').value = res.data.role;
            document.querySelector('[name="status"]').value = res.data.status;
            // password thường để trống khi edit
            document.querySelector('[name="password"]').value = '';
            document.querySelector('[name="password_confirmation"]').value = '';

            // 👉 đổi title nếu edit
            document.querySelector('.modal-title').innerText = 'Edit User';

            // 👉 show modal
            const myModal = new bootstrap.Modal(document.getElementById('userModal'));
            myModal.show();
        
        });
    });
});
// hidden.bs.modal 
document.getElementById('userModal').addEventListener('hidden.bs.modal', function () {
    // 👉 reset form khi đóng modal
    document.getElementById('userForm').reset();
    document.getElementById('userId').value = '';
    document.querySelector('.modal-title').innerText = 'Add User';
});



//function 
async function confirmDialog({
    action,
    text,
    value,
    title = 'Thông báo',
    icon = 'warning' // warning, success, error, info, question
}) {
    const result = await Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonText: 'Đồng ý',
        cancelButtonText: 'Hủy bỏ',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        reverseButtons: true
    });

    if (!result.isConfirmed) return;

    // action map (giống bản bạn nhưng clean hơn)
    const actions = {
        'delete-item': () => deleteItem(value),
        'delete-all': () => deleteAll(value),
        'edit-item-modal': () => editItem(value)
    };

    if (actions[action]) {
        actions[action]();
    } else {
        console.warn('Action không tồn tại:', action);
    }
}
/* Delete item */
function deleteItem(url) {
	document.location = url;
}

/* Delete all */
function deleteAll(url) {
	var listid = '';
	const parts = url.split('?');
	var url = parts[0];
	const params = parts.length > 1 ? parts[1] : null;

	$('table tbody input.form-check-input').each(function () {
		if (this.checked) {
			listid = listid + ',' + parseInt(this.value);
		}
	});
	$('ul.list-unstyled input.form-check-input').each(function () {
		if (this.checked) {
			listid = listid + ',' + parseInt(this.value);
		}
	});
	listid = listid.substr(1);
	if (listid == '') {
		notifyDialog('Bạn phải chọn ít nhất 1 mục để xóa');
		return false;
	}
	document.location = url + '?listid=' + listid + '&' + params;
}