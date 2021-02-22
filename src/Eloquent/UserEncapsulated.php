<?php

declare(strict_types=1);

namespace App\Eloquent;

use App\Config\DbUserConfig;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserEncapsulated
 * @package App\Eloquent
 */
class UserEncapsulated extends Model
{
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * UserEncapsulated constructor.
     * @param array $attributes
     * @param DbUserConfig|null $config
     */
    public function __construct(array $attributes = [], DbUserConfig $config = null)
    {
        if ($config === null) {
            $config = new DbUserConfig();
        }

        Encapsulator::init($config);

        parent::__construct($attributes);
    }

    /**
     * Mutator to set capitalised name value.
     *
     * @param $value
     */
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = self::titleCase($value);
    }

    /**
     * Mutator to set capitalised Surname value.
     *
     * @param $value
     */
    public function setSurnameAttribute($value): void
    {
        $this->attributes['surname'] = self::titleCase($value);
    }

    /**
     * Mutator to set lower cased email value.
     *
     * @param $value
     */
    public function setEmailAttribute($value): void
    {
        $this->attributes['email'] = strtolower($value);
    }

    /**
     * Proper name capitalisation.
     *
     * @param string $string
     * @return string
     */
    public static function titleCase(string $string): string
    {
        $word_splitters = array(' ', '-', "O'", "L'", "D'", 'St.', 'Mc');
        $lowercase_exceptions = array('the', 'van', 'den', 'von', 'und', 'der', 'de', 'da', 'of', 'and', "l'", "d'");
        $uppercase_exceptions = array('III', 'IV', 'VI', 'VII', 'VIII', 'IX');

        $string = strtolower($string);
        foreach ($word_splitters as $delimiter) {
            $words = explode($delimiter, $string);
            $newWords = array();
            foreach ($words as $word) {
                if (in_array(strtoupper($word), $uppercase_exceptions)) {
                    $word = strtoupper($word);
                } elseif (!in_array($word, $lowercase_exceptions)) {
                    $word = ucfirst($word);
                }

                $newWords[] = $word;
            }

            if (in_array(strtolower($delimiter), $lowercase_exceptions)) {
                $delimiter = strtolower($delimiter);
            }

            $string = join($delimiter, $newWords);
        }
        return $string;
    }
}
