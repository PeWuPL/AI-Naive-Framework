<?php
namespace App\Model;

use App\Service\Config;

abstract class Common
{
    protected ?int $id = null;

    /** Database table name. */
    abstract protected static function table(): string;

    /** Map of database column => property name (without `id`). */
    abstract protected static function columns(): array;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): static
    {
        $this->id = $id;

        return $this;
    }

    protected static function connect(): \PDO
    {
        return new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
    }

    public static function fromArray($array): static
    {
        $model = new static();
        $model->fill($array);

        return $model;
    }

    public function fill($array): static
    {
        if (isset($array['id']) && ! $this->getId()) {
            $this->setId($array['id']);
        }
        foreach (static::columns() as $column => $property) {
            if (isset($array[$column])) {
                $this->{'set' . ucfirst($property)}($array[$column]);
            }
        }

        return $this;
    }

    public static function findAll(): array
    {
        $statement = self::connect()->prepare('SELECT * FROM ' . static::table());
        $statement->execute();

        $models = [];
        foreach ($statement->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $models[] = static::fromArray($row);
        }

        return $models;
    }

    public static function find($id): ?static
    {
        $statement = self::connect()->prepare('SELECT * FROM ' . static::table() . ' WHERE id = :id');
        $statement->execute(['id' => $id]);

        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $row) {
            return null;
        }

        return static::fromArray($row);
    }

    public function save(): void
    {
        $pdo = self::connect();
        $columns = array_keys(static::columns());
        $params = [];
        foreach (static::columns() as $column => $property) {
            $params[':' . $column] = $this->{'get' . ucfirst($property)}();
        }

        if (! $this->getId()) {
            $sql = sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                static::table(),
                implode(', ', $columns),
                implode(', ', array_keys($params))
            );
            $pdo->prepare($sql)->execute($params);

            $this->setId($pdo->lastInsertId());
        } else {
            $assignments = array_map(fn($c) => "$c = :$c", $columns);
            $sql = sprintf('UPDATE %s SET %s WHERE id = :id', static::table(), implode(', ', $assignments));
            $params[':id'] = $this->getId();
            $pdo->prepare($sql)->execute($params);
        }
    }

    public function delete(): void
    {
        $statement = self::connect()->prepare('DELETE FROM ' . static::table() . ' WHERE id = :id');
        $statement->execute([':id' => $this->getId()]);

        $this->setId(null);
        foreach (static::columns() as $property) {
            $this->{'set' . ucfirst($property)}(null);
        }
    }
}
