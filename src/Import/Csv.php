<?php

namespace App\Import;

use League\Csv\Exception;
use League\Csv\Reader;
use League\Csv\Statement;
use Illuminate\Database\Eloquent\Collection;

class Csv implements ImportableInterface
{
    /**
     * The header column keys of the CSV file.
     */
    public const CSV_HEADER_KEYS = ['name', 'surname', 'email'];

    /**
     * @var array
     */
    protected $rows;

    /**
     * @var string
     */
    protected $path;

    /**
     * Csv constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Load the file content from the source using League\Csv\Reader.
     * @throws Exception
     */
    public function load(): void
    {
        $reader = Reader::createFromPath($this->path, 'r');
        $reader->setHeaderOffset(0);
        $this->rows = (new Statement())->process($reader, self::CSV_HEADER_KEYS);
    }

    /**
     * Convert to user collection.
     *
     * @return Collection
     * @throws Exception
     */
    public function toCollection(): Collection
    {
        $rows = $this->rows;
        if (!count($rows)) {
            throw new Exception('Error, the CSV file seems empty.');
        }

        $users = new Collection();

        foreach ($rows as $row) {
            $user = new User(
                $row[self::CSV_HEADER_KEYS[0]],
                $row[self::CSV_HEADER_KEYS[1]],
                $row[self::CSV_HEADER_KEYS[2]]
            );

            $users->add($user);
        }

        return $users;
    }
}
