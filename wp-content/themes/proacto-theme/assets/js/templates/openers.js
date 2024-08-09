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

const loginSwitchers = document.querySelectorAll('.login-switcher')
const loginBlocks  = document.querySelectorAll('.login-block')
if (loginSwitchers) {
    loginSwitchers.forEach(switcher => {
        switcher.addEventListener('click', function(e) {
            e.preventDefault()
            let id = this.dataset.id
            loginBlocks.forEach(block => {
                if (block.id === id) {
                    block.classList.remove('hidden')
                } else {
                    block.classList.add('hidden')
                }
            })

        })
    })
}