<?php


namespace App\Domain\Translation\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Trait Translatable
 * @package App\Domain\TranslationTest
 * @method Builder whereEntry(string $column, string $operator, string $value)
 * @method Builder orWhereEntry(string $column, string $operator, string $value)
 *
 * @mixin \Eloquent
 */
trait Translatable
{
    /**
     * @param $key
     * @return mixed|void
     */
    public function getAttribute($key)
    {
        if (!$key)
            return;

        if ($this->isTranslatable($key))
            return $this->translateAttribute($key);

        if (isset($this->attributes[$key]) || $this->hasGetMutator($key))
            return $this->getAttributeValue($key);

        if (method_exists(parent::class, $key))
            return;

        return $this->getRelationValue($key);
    }

    /**
     * @param string $key
     * @return Collection|null
     */
    public function getTranslations(string $key): ?Collection
    {
        $source = null;

        if ($this->getOriginal($key) !== null)
            $source = $this->getOriginal($key);

        if ($source === null && $this->attributesToArray()[$key])
            $source = $this->attributesToArray()[$key];

        return collect(json_decode($source));
    }

    public function setAttribute($key, $value)
    {
        if ($this->isTranslatable($key)) {
            $this->setTranslatableAttribute($key, $value);
            return $this;
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * @param string $key
     * @return bool
     */
    protected function isTranslatable(string $key): bool
    {
        return in_array($key, $this->getTranslatable());
    }

    /**
     * @param string $key
     * @return string|null
     */
    protected function translateAttribute(string $key): ?string
    {
        if (($entries = $this->getTranslations($key))->isEmpty())
            return null;

        return $entry = $entries[app()->getLocale()] ?? $entries->first();
    }

    /**
     * @param string $key
     * @param array|Collection|string $value
     */
    protected function setTranslatableAttribute(string $key, $value): void
    {
        if (is_string($value) && !empty($value))
            $value = [app()->getLocale() => $value];

        if ($this->isTranslatableValueValid($value))
            $this->attributes[$key] = json_encode((object)$value, JSON_UNESCAPED_UNICODE);
        else
            $this->attributes[$key] = json_encode(new class
            {
            }, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $value
     * @return bool
     */
    private function isTranslatableValueValid($value): bool
    {
        return is_array($value) || $value instanceof Collection;
    }

    /**
     * @param Builder $query
     * @param string $column
     * @param string $operator
     * @param string $value
     * @return Builder
     */
    public function scopeWhereEntry($query, string $column, string $operator, string $value = null): Builder
    {
        return isset($value) ? $query->whereRaw($this->whereEntrySql($column, $operator), [$value]) : $query;
    }

    /**
     * @param Builder $query
     * @param string $column
     * @param string $operator
     * @param string|null $value
     * @return Builder
     */
    public function scopeOrWhereEntry($query, string $column, string $operator, string $value = null): Builder
    {
        return isset($value) ? $query->orWhereRaw($this->whereEntrySql($column, $operator), [$value]) : $query;
    }

    private function whereEntrySql(string $column, string $operator): string
    {
        $column = sprintf("%s.%s", $this->getTable(), $column);
        return "lower($column) $operator lower(?)";
    }

    /**
     * @return array
     */
    protected abstract function getTranslatable(): array;
}
