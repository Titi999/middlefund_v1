const dropZone = document.querySelector('.image-upload');
        const inputElement = document.querySelector('input');
        const img = document.querySelector('.myImg');
        let p = document.querySelector('.hide')

        inputElement.addEventListener('change', function (e) {
            const clickFile = this.files[0];
            if (clickFile) {
                img.style = "display:block;";
                p.style = 'display: none';
                const reader = new FileReader();
                reader.readAsDataURL(clickFile);
                reader.onloadend = function () {
                    const result = reader.result;
                    let src = this.result;
                    img.src = src;
                    img.alt = clickFile.name
                    document.querySelector(".iconWrite").style.display = "flex";
                }
            }
        })
        dropZone.addEventListener('click', () => inputElement.click());
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
        });
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            img.style = "display:block;";
            let file = e.dataTransfer.files[0];

            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onloadend = function () {
                e.preventDefault()
                p.style = 'display: none';
                let src = this.result;
                img.src = src;
                img.alt = file.name
            }
        });