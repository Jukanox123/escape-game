$(document).ready(function () {

    // cache the jquery elements to prevent dom queries during the animation events
    var $word = $(".word");

    // when the animation iterates
    $("h1").on('webkitAnimationIteration oanimationiteration msAnimationIteration animationiteration ', function () {

        // replace the header with a random word
        var word = words[Math.floor(Math.random() * words.length)] + "!";
        $word.text(word);
    });
});

// the 10,000 most comment words, taken from https://goo.gl/hfjFkz
words = ["Too late", "So bad", "One more victim", "Failure", "You disappoint me", "Game over", "Got your file"];
        