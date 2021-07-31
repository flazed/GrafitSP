try {
    const upload_photo = document.querySelector('form .upload');
    const input = upload_photo.querySelector('input');
    const img = upload_photo.querySelector('img');
    let file;
    
    input.addEventListener('change', () => {
        preview();
    });

    function preview() {
        let fileType = false;

        const type = input.files[0].type.replace(/.+\//, '');
        switch(type) {
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'bmp': fileType = true; break;
        }
        
        if(fileType) {
            img.src = URL.createObjectURL(input.files[0]);
            if(file !== input.files[0]) {
                img.classList.remove('active');
                img.classList.add('disabled');

                setTimeout(() => {
                    img.classList.remove('disabled');
                    img.classList.add('active');
                }, 300);
            }
            
            file = input.files[0];
        }
    }
} catch (error) {}