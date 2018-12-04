console.log("Itsa me!");

function upvoteAction(doc) {

    if (this.style.color === 'green')
        this.style.color = '';
    else {
        let associatedDownvote = doc.getElementById('downvote' + this.id.match(/upvote(\d+)/)[1]);
        associatedDownvote.style.color = '';
        this.style.color = 'green';
    }
}

function downvoteAction(doc) {

    if (this.style.color === 'red')
        this.style.color = '';
    else {
        let associatedDownvote = doc.getElementById('upvote' + this.id.match(/downvote(\d+)/)[1]);
        associatedDownvote.style.color = '';
        this.style.color = 'red';
    }

}

let upvotes = document.querySelectorAll('i[id^="upvote"]');
let downvotes = document.querySelectorAll('i[id^="downvote"]');

for (let i = 0; i < upvotes.length; i++) {
    upvotes[i].addEventListener('click', upvoteAction.bind(upvotes[i], document));
}

for (let i = 0; i < downvotes.length; i++) {
    downvotes[i].addEventListener('click', downvoteAction.bind(downvotes[i], document));
}