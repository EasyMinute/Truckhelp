const seoTexts = document.querySelectorAll('.seo_text')
if (seoTexts) {
    seoTexts.forEach(block => {
        const body = block.querySelector('.seo_text__body')
        const button = block.querySelector('.seo_text__button')
        if (body && button) {
            button.addEventListener('click', function(){
                console.log('body', body)
                body.classList.toggle('opened')
                button.classList.toggle('opened')
            })
        }
    })
}