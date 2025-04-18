document.addEventListener('DOMContentLoaded', () => {
    // File Upload Handling
    const uploadForm = document.getElementById('uploadForm');
    const spinner = document.querySelector('.spinner');
    
    uploadForm.addEventListener('submit', (e) => {
        spinner.classList.remove('hidden');
    });

    // Delete Confirmation
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            if (!confirm('Are you sure you want to delete this receipt?')) {
                e.preventDefault();
            }
        });
    });

    // Auto-close toast messages
    setTimeout(() => {
        document.querySelectorAll('.toast').forEach(toast => {
            toast.remove();
        });
    }, 5000);
});