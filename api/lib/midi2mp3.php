<?php 

class Midi2Mp3 {

    // dossier temporaire pour le traitement lilypond
    const TMP_DIR = '/tmp/midi2mp3';

    // Id de session unique
    private $id;

    // Dossier de travail pour la session
    private $dir;

    // Chemin complet du fichier d'entrée
    private $inputFile;

    // Chemin complet du fichier de log FluidSynth
    private $logFileFS;

    // Chemin complet du fichier de log Lame
    private $logFileLame;


    //-----------------------------------------
    // CONVERTION
    //-----------------------------------------

    public function convert($midiData, $soundfont) {

        try {

            // Initialisation
            $this->initPath();
            mkdir($this->dir,0777, true);
            file_put_contents($this->inputFile,base64_decode($midiData));

            // Execution FluidSynth
            $soundfontDir = dirname(__DIR__) . '/soundfonts';
            $cmd  = "fluidsynth -F $this->dir/$this->id.wav $soundfontDir/$soundfont.sf2 $this->dir/$this->id.midi > $this->logFileFS 2>&1";
            exec($cmd,$op,$retVal);
            if ($retVal!=0) throw new Exception("Erreur lors de l'execution fluidSynth");

            // Execution Lame
            $cmd  = "lame $this->dir/$this->id.wav > $this->logFileLame 2>&1";
            exec($cmd,$op,$retVal);
            if ($retVal!=0) throw new Exception("Erreur lors de l'execution lame");

            // Compose le retour OK
            $result = $this->getConvertResponse(true,'');

        } catch (Exception $ex) {

            // Compose le retour ERREUR
            $result = $this->getConvertResponse(false, $ex->getMessage());
        }

        return $result;
    }

    /**
     * Initialise les chemins
     */
    private function initPath() {
        $this->id = uniqid();
        $this->dir = self::TMP_DIR . '/' . $this->id;
        $this->inputFile = $this->dir . '/' . $this->id . ".midi";
        $this->logFileFS = $this->dir . '/' . $this->id . ".fluidSynth.log";
        $this->logFileLame = $this->dir . '/' . $this->id . ".lame.log";
    }

    /**
     * Prepare la réponse du Convert
     * @param $success
     * @param $message
     * @return array
     */
    private function getConvertResponse($success, $message) {
        return array(
            'status' => array(
                'code' => $success ? 'OK' : 'ERROR',
                'message' => $message
            ),
            'base64Mp3Data' => $this->getResultFile(),
            'logs' => $this->getLogFiles()
        );
    }

    /**
     * Charge les données du fichier resultat
     * @return string
     */
    private function getResultFile() {
        $result = '';
        $file = "$this->dir/$this->id.mp3";
        if (is_file($file)) {
            $result = base64_encode(file_get_contents($file));
        }
        return $result;
    }

    /**
     * Charge les données du fichier de log
     * @return array
     */
    private function getLogFiles() {
        $logs = array();
        if (is_file($this->logFileFS)) {
            $logs[] = array(
                'title' => 'FluidSynth : Convertion midi -> wav',
                'content' => file_get_contents($this->logFileFS)
            );
        }
        if (is_file($this->logFileLame)) {
            $logs[] = array(
                'title' => 'Lame : Convertion wav -> mp3',
                'content' => file_get_contents($this->logFileLame)
            );
        }
        return $logs;
    }

}