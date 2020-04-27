<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Exception\ValidatorException;
use Throwable;

/**
 * Violations handled by exception
 */
class ValidationException extends ValidatorException
{
    protected ConstraintViolationListInterface $violations;

    public function __construct(ConstraintViolationListInterface $violations, $code = 0, Throwable $previous = null)
    {
        parent::__construct('These constraints failed.', $code, $previous);
        $this->violations = $violations;
    }

    public function getViolations(): ConstraintViolationListInterface
    {
        return $this->violations;
    }
}
