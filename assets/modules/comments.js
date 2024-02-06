document.addEventListener('DOMContentLoaded', () => {

    loadFunctionLoveToCommentButtons()

})

function loadFunctionLoveToCommentButtons() {

    const loveToCommentButtons = document.querySelectorAll('.love-to-comment');

    loveToCommentButtons.forEach(button => {

        button.addEventListener('click', sendLoveToComment);

    })

}

const sendLoveToComment = (event) => {

    event.preventDefault();

    if(event.currentTarget.hasAttribute('disabled')) {
        return;
    }

    const commentId = event.currentTarget.getAttribute('data-comment-id');
    const userId = event.currentTarget.getAttribute('data-user-id');
    const commentAmountLove = document.querySelector(`#love-amount-for-comment-${commentId}`);
    const commentIcon = document.querySelector(`#love-icon-comment-${commentId}`);

    commentAmountLove.innerHTML = '' + (parseInt(commentAmountLove.innerHTML) + 1);
    commentIcon.classList.add('text-red-500');

    fetch(`/comment/${commentId}/love/${userId}`, {})
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.log(error))

    event.currentTarget.setAttribute('disabled', 'disabled');
}