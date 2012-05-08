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

    public function validateDouble($word_id) {
//        phpinfo();die;
        $this->load->database();
        $query = $this->db->get_where('test.words', array('word_id' => $word_id));
        $result = $query->result();

        $this->db->where('word_id', $word_id)->update('test.words', array('validated' => 'true') );
        $this->db->where(array('word_value='=> $result[0]->word_value, 'word_id!=' => $word_id) )->update('test.words', array('deleted' => 'true') );
        echo  'true';
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
        //		$this->viewlinker->addJsScript('include/import');
        $this->load->database();

        if( !$this->input->post('length') ) {
            $length = 3;
        } else {
            $length = $this->input->post('length');
        }
        // Requete pour avoir les doublons
        // SELECT Count(*), word_value FROM  test.words GROUP BY word_value HAVING Count(*) > 1
        $query = $this->db->query("SELECT * FROM test.words WHERE length = ".$length ." AND deleted = false");
        $view_data['words_list'] = $query->result();

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