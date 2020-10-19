<?php

use PhpMyAdmin\MoTranslator\ReaderException;
use PhpMyAdmin\MoTranslator\StringReader;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class Loader {
    public function getTranslator($domain = '') {
        $filename = 'test.mo';
        $this->domains[$domain] = new Translator($filename);
        echo 'we should get here without errors';
    }
}

class Translator
{
    /**
     * None error.
     */
    const ERROR_NONE = 0;
    /**
     * File does not exist.
     */
    const ERROR_DOES_NOT_EXIST = 1;
    /**
     * File has bad magic number.
     */
    const ERROR_BAD_MAGIC = 2;
    /**
     * Error while reading file, probably too short.
     */
    const ERROR_READING = 3;

    /**
     * Big endian mo file magic bytes.
     */
    const MAGIC_BE = "\x95\x04\x12\xde";
    /**
     * Little endian mo file magic bytes.
     */
    const MAGIC_LE = "\xde\x12\x04\x95";

    /**
     * Parse error code (0 if no error).
     *
     * @var int
     */
    public $error = self::ERROR_NONE;

    /**
     * Cache header field for plural forms.
     *
     * @var string|null
     */
    private $pluralequation = null;
    /**
     * @var ExpressionLanguage|null Evaluator for plurals
     */
    private $pluralexpression = null;
    /**
     * @var int|null number of plurals
     */
    private $pluralcount = null;
    /**
     * Array with original -> translation mapping.
     *
     * @var array
     */
    private $cache_translations = array();

    /**
     * Constructor.
     *
     * @param string $filename Name of mo file to load
     */
    public function __construct($filename)
    {
        if (!is_readable($filename)) {
            $this->error = self::ERROR_DOES_NOT_EXIST;

            return;
        }

        $stream = new StringReader($filename);

        try {
            $magic = $stream->read(0, 4);
            if (strcmp($magic, self::MAGIC_LE) == 0) {
                $unpack = 'V';
            } elseif (strcmp($magic, self::MAGIC_BE) == 0) {
                $unpack = 'N';
            } else {
                $this->error = self::ERROR_BAD_MAGIC;

                return;
            }

            /* Parse header */
            $total = $stream->readint($unpack, 8);
            $originals = $stream->readint($unpack, 12);
            $translations = $stream->readint($unpack, 16);

            /* get original and translations tables */
            $table_originals = $stream->readintarray($unpack, $originals, $total * 2);
            $table_translations = $stream->readintarray($unpack, $translations, $total * 2);

            /* read all strings to the cache */
            for ($i = 0; $i < $total; ++$i) {
                $original = $stream->read($table_originals[$i * 2 + 2], $table_originals[$i * 2 + 1]);
                $translation = $stream->read($table_translations[$i * 2 + 2], $table_translations[$i * 2 + 1]);
                $this->cache_translations[$original] = $translation;
            }
        } catch (ReaderException $e) {
            $this->error = self::ERROR_READING;

            return;
        }
    }
}

$class_loader = new Loader;
$translator = $class_loader->getTranslator();