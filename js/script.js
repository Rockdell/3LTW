console.log("Itsa me!");

function upvoteAction(doc) {
    if (this.checked) {
        let associatedDownvote = doc.getElementById('downvote' + this.id.match(/upvote(\d+)/)[1]);
        console.log(associatedDownvote);
        associatedDownvote.checked = false;
    }
}

function downvoteAction(doc) {
    if (this.checked) {
        let associatedUpvote = doc.getElementById('upvote' + this.id.match(/downvote(\d+)/)[1]);
        console.log(associatedUpvote);
        associatedUpvote.checked = false;
    }
}

let upvotes = document.querySelectorAll('#post-info input[id^="upvote"]');
let downvotes = document.querySelectorAll('#post-info input[id^="downvote"]');

for (let i = 0; i < upvotes.length; i++) {
    upvotes[i].addEventListener('click', upvoteAction.bind(upvotes[i], document));
}

for (let i = 0; i < downvotes.length; i++) {
    downvotes[i].addEventListener('click', downvoteAction.bind(downvotes[i], document));
}

// function upvoteAction(doc) {

//     if (this.style.color === 'green')
//         this.style.color = '';
//     else {
//         let associatedDownvote = doc.getElementById('downvote' + this.id.match(/upvote(\d+)/)[1]);
//         associatedDownvote.style.color = '';
//         this.style.color = 'green';
//     }
// }

// function downvoteAction(doc) {

//     if (this.style.color === 'red')
//         this.style.color = '';
//     else {
//         let associatedDownvote = doc.getElementById('upvote' + this.id.match(/downvote(\d+)/)[1]);
//         associatedDownvote.style.color = '';
//         this.style.color = 'red';
//     }

// }

// let upvotes = document.querySelectorAll('i[id^="upvote"]');
// let downvotes = document.querySelectorAll('i[id^="downvote"]');

// for (let i = 0; i < upvotes.length; i++) {
//     upvotes[i].addEventListener('click', upvoteAction.bind(upvotes[i], document));
// }

// for (let i = 0; i < downvotes.length; i++) {
//     downvotes[i].addEventListener('click', downvoteAction.bind(downvotes[i], document));
// }