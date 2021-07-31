try {
    const upload_photo = document.querySelector('form .upload');
    const input = upload_photo.querySelector('input');
    const imgs = document.querySelector('#imgs');
    let count;

    input.addEventListener('change', () => {
        files = [];
        count = 0;
        imgs.innerHTML = '';
        for (let file of Object.values(input.files)) {
            if(count < 3) {
                preview(file);
            } else {
                break;
            }
            count++;
        }
    });

    function preview(file) {
        imgs.innerHTML += `
            <div">
                <div class="img-product">
                    <img src="${URL.createObjectURL(file)}">
                </div>
            </div>
        `;
    }
} catch (error) {}
