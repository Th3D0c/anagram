<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends CI_Controller {

    public function test() {
//		$this->viewlinker->addJsScript('include/welcome');
        $this->load->database();

        $done = 0;

        $handle = fopen(APPPATH."controllers/wordsAnalyzer/words_lists/liste_francais.txt", "r");
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                echo $buffer;

                $object = new StdClass();
                $object->word_label = trim($buffer);
                $patern =  array('é','è','ê','ë',
                                 'ì','í','î','ï',
                                 'ù','û','ü','ú',
                                 'ò','ó','ô','õ','ö','ø',
                                 'à','','à','à','ã','å',
                                 'œ','æ','ç'
                                );
                $replace = array('e','e','e','e',
                                 'i','i','i','i',
                                 'u','u','u','u',
                                 'o','o','o','o','o','o',
                                 'a','a','a','a','a','a',
                                 'oe','ae','c'
                                );
                $object->word_value = strtolower( str_replace($patern, $replace,  $object->word_label ) );
                $object->length = mb_strlen($object->word_label);
                $letter_counter = array();
                for($i=0; $i < $object->length; $i++) {
                    $letter_counter[$object->word_value[$i]] = true;
                }
                $object->undoubled_length = count($letter_counter);
                $object->language_id = 1; // 1 = FR
                $object->validated = 'false';
//                var_dump($object);


//                $result = $this->db->insert('test.words', $object);
//                if($result) {
//                    $done++;
//                } else {
//                    file_put_contents(APPPATH."controllers/wordsAnalyzer/words_lists/debug.log", var_export($object,true), FILE_APPEND);
//                }
            }
            if (!feof($handle)) {
                echo "Erreur: fgets() a échoué\n";
            }
            fclose($handle);
        }

                var_dump($done);

    	$view_data = null;
    	$this->viewlinker->view('wordsAnalyzer/import_index', $view_data);
	}

    public function populateLetters() {
        $this->load->database();
        for($i='a'; $i != 'aa'; $i++) {
//            $this->db->insert('test.letters', array('letter_value' => $i) );
//            echo $i;
            
            $query = "insert into test.letters_by_words (letter_id, word_id)
                            select l.letter_id,  w.word_id
                            from test.words w,
                                test.letters l
                            WHERE
                                word_value LIKE '%".$i."%'
                                AND letter_value='".$i."'";
//            if($this->db->query($query)) {
//                echo $i;
//            } else {
//                echo '<br/>WRONG '.$i.'<br/>';
//            }

        }
        echo '<br/><br/>Done';
    }

    public function validateDouble($word_id) {
//        phpinfo();die;
        $this->load->database();
        $query = $this->db->get_where('test.words', array('word_id' => $word_id));
        $result = $query->result();

        $this->db->where('word_id', $word_id)->update('test.words', array('validated' => 'true') );
        $this->db->where(array('word_value='=> $result[0]->word_value, 'word_id!=' => $word_id) )->update('test.words', array('deleted' => 'true') );
        echo  'true';
    }

    public function validateWord($word_id) {
        $this->load->database();
        if( $this->db->where('word_id', $word_id)->update('test.words', array('validated' => 'true') ) ){
            echo  'true';
        } else {
            echo 'false';
        }
    }

    public function deleteWord($word_id) {
        $this->load->database();
        if( $this->db->where('word_id', $word_id)->update('test.words', array('deleted' => 'true') ) ){
            echo  'true';
        } else {
            echo 'false';
        }
    }

    public function checkDoublons() {
		$this->viewlinker->addJsScript('include/import');
        $this->load->database();
        // Requete pour avoir les doublons
        // SELECT Count(*), word_value FROM  test.words GROUP BY word_value HAVING Count(*) > 1
        $query = $this->db->query("SELECT * FROM test.words
                                   WHERE
                                        word_value IN (
                                                SELECT word_value
                                                FROM test.words
                                                WHERE
                                                    deleted = FALSE
                                                    AND length BETWEEN 3 AND 8
                                                GROUP BY
                                                    word_value
                                                HAVING
                                                    Count(*) > 1
                                                ORDER BY
                                                    word_value
                                                    )");

        foreach ($query->result() as $row)
        {
            if(strlen($row->word_value) > 2 && strlen($row->word_value) < 8) {
                $view_data['doublon_list'][$row->word_value][] = $row;
            }
        }
    	$this->viewlinker->view('wordsAnalyzer/import_checkDoublons', $view_data);
	}

    public function checkByLength() {
        $this->viewlinker->addJsScript('include/import');
        $this->load->database();

        if( !$this->input->get('length') ) {
            $view_data['length'] = 3;
        } else {
            $view_data['length'] = $this->input->get('length');
        }

        $view_data['words_length'] = null;
        for($i=3; $i < 9; $i++) {
            if($view_data['length'] == $i) {
                $selected = ' selected="selected"';
            } else {
                $selected = null;
            }
            $view_data['words_length'] .= '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
        }
        // Requete pour avoir les doublons
        // SELECT Count(*), word_value FROM  test.words GROUP BY word_value HAVING Count(*) > 1
        $query = $this->db->query("SELECT * FROM test.words WHERE length = ".$view_data['length'] ." AND deleted = false AND validated = false");
//        $view_data['words_list'] = $query->result();
        foreach ($query->result() as $data ){
            $view_data['words_list'][$data->word_value[0]][] = $data;
        }

    	$this->viewlinker->view('wordsAnalyzer/import_checkByLength', $view_data);
	}

	/**
	* Index Page for this controller.
	*
	*/
	public function index() {
//		$this->viewlinker->addJsScript('include/welcome');
        $this->load->database();

    	$view_data = null;
    	$this->viewlinker->view('wordsAnalyzer/import_index', $view_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

//select * from test.words w WHERE word_id IN ( SELECT word_id from test.words w2 WHERE w2.word_value=w.word_value  ) > 0