<div id="container" >
    <h1>Words Validation by length</h1>
    <form action="" method="get">
        Word length:<select name="length" id="length">
            <?=$words_length;?>
        </select>
        <input type="submit" />
    </form>
    <br/>
    <div id="result_box"></div>
    <?php //
    for($i='a'; $i != 'aa'; $i++) {
        echo '<a href="/wordsAnalyzer/import/checkByLength?length='.$length.'#'.$i.'">'.$i.'</a> / ';
    }

    foreach($words_list as $first_letter => $associated_words) {
        echo '<h2 id="'.$first_letter.'">'.$first_letter.'</h2>';
        foreach($associated_words as $word) {

            echo '<div class="doublons_entry_'.intval($word->validated).'_'.intval($word->deleted).'">
                        <div style="display: inline-block; vertical-align: top;">
                        <em> #'.$word->word_id.'</em> <br/><b>'.$word->word_label.'</b>
                        </div>
                        <div style="display: inline-block;">
                            <a href="http://www.google.com/search?q=dictionnaire+'.$word->word_label.'">link dico</a> <br/>
                            <button onclick="validateWord('.$word->word_id.');">validate</button>
                            <button onclick="deleteWord('.$word->word_id.');">Delete</button>
                        </div>
                    </div><hr/> ';
        }
    }

    ?>
    <div align="center">
        abandonne<br/>
        <div style="display: inline-block;">
            <div style="display: inline-block; vertical-align: top;">
                abandonne
            </div>
            <div style="display: inline-block;">
                <a href="http://www.google.com/search?q=dictionnaire+abandonné">link dico</a> <br/>
                link validate this for doublon
            </div>
        </div>

        <div style="display: inline-block;">
            <div style="display: inline-block; vertical-align: top;">
                abandonné
            </div>
            <div style="display: inline-block;">
                <a href="http://www.google.com/search?q=dictionnaire+abandonné">link dico</a> <br/>
                link validate this for doublon
            </div>
        </div>
    <div>
    <br/><br/><br/><br/><br/><br/>

</div>

