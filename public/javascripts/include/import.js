function validateDoublon(word_id) {
    if( confirm('Validate word #'+word_id) ) {
        $.get("/wordsAnalyzer/import/validateDouble/" + word_id, function(result){
            if(result == 'true') {
                alert("Word #" + word_id +  " successfully validated");
                window.location.href = "/wordsAnalyzer/import/checkDoublons";
            } else {
                alert("Can not validate word #" + word_id);
                console.log('Error returned is: ' + result);
            }

        });
    }
} // END validateDoublon

function validateWord(word_id) {
    if( confirm('Validate word #'+word_id) ) {
        $.get("/wordsAnalyzer/import/validateWord/" + word_id, function(result){
            if(result == 'true') {
                window.location.href = "/wordsAnalyzer/import/checkByLength?length=" + $('#length option:selected').val();
            } else {
                alert("Can not validate word #" + word_id);
                console.log('Error returned is: ' + result);
            }
        });
    }
} // END validateDoublon

function deleteWord(word_id) {
    if( confirm('DELETE word #'+word_id) ) {
        $.get("/wordsAnalyzer/import/deleteWord/" + word_id, function(result){
            if(result == 'true') {
                window.location.href = "/wordsAnalyzer/import/checkByLength?length=" + $('#length option:selected').val();
            } else {
                alert("Can not delete word #" + word_id);
                console.log('Error returned is: ' + result);
            }
        });
    }
} // END validateDoublon

$(document).ready(function() {

}); // END Document.ready