const buttonOpeners = document.querySelectorAll('.button-opener')
if (buttonOpeners) {
    buttonOpeners.forEach(opener => {
        opener.addEventListener('click', function(e) {
            e.preventDefault();
            let target = this.dataset.target
            let action = this.dataset.action
            const targetElem = document.getElementById(target)

            if (action === 'toggle') {
                targetElem.classList.toggle('opened')
            } else if (action === 'remove') {
                targetElem.classList.remove('opened')
            } else {
                targetElem.classList.add('opened')
            }
        })
    })
}