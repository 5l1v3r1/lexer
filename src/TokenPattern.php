<?php declare(strict_types=1);

namespace CageIs\Lexer;

class TokenPattern
{
    /**
     * @var string
     */
    private $pattern;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $isCaseSensitive;

    /**
     * TokenLocator constructor.
     * @param string $pattern
     * @param string $name
     * @param bool $isCaseSensitive
     */
    public function __construct(string $pattern, string $name, bool $isCaseSensitive = true)
    {
        $this->pattern = $pattern;
        $this->name = $name;
        $this->isCaseSensitive = $isCaseSensitive;
    }

    /**
     * @param string $segment
     * @return string|null
     */
    public function match(string $segment): ?string
    {
        preg_match("/^({$this->pattern})/{$this->getFlags()}", $segment, $matches);
        return $matches[1] ?? null;
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the flags that are used for the regex pattern.
     *
     * @return string
     */
    private function getFlags(): string
    {
        $flags = [
            $this->isCaseSensitive ? '' : 'i',
        ];
        return implode('', $flags);
    }
}
