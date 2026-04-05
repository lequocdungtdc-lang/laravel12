export function handleUserAction(action, id, url) {
    switch (action) {
        case 'edit':
            window.location.href = `${url}/${id}/edit`;
            break;

        case 'delete':
            if (!confirm('Bạn chắc chắn muốn xóa?')) return;

            fetch(`${url}/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(res => res.json())
            .then(data => {
                console.log('Deleted:', data);
                location.reload();
            });
            break;

        case 'view':
            window.location.href = `${url}/${id}`;
            break;

        default:
            console.warn('Unknown action:', action);
    }
}

