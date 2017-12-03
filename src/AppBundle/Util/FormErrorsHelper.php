<?php
/*
 * Created by Nazar Salo.
 * as the part of the test Task for MoneyFGE
 * at 02.12.17 18:25
 */

namespace AppBundle\Util;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;

/**
 * Class FormErrorsHelper
 * @package AppBundle\Util
 * @author Nazar Salo <salo.nazar@gmail.com>
 */
class FormErrorsHelper
{
    const AS_STRING = 'String';
    const AS_JSON = 'Json';
    const AS_ARRAY = 'Array';

    /**
     * Parse form errors.
     * @param FormInterface $form
     * @param string $type
     * @return array
     * @throws \Exception
     */
    public static function parse(FormInterface $form, $type = self::AS_ARRAY)
    {
        $errors = self::recursionParse($form->getErrors(true, false), []);

        if ($type === self::AS_ARRAY) {
            return $errors;
        }

        $method = self::getMethod($type);

        return static::$method($errors);
    }

    /**
     * @param $error
     * @param $errors
     * @return mixed
     */
    private static function recursionParse($error, $errors)
    {
        if ($error instanceof FormError) {
            $errors[$error->getOrigin()->getConfig()->getName()][] = $error->getMessage();
        } else {
            foreach ($error as $r) {
                $errors = self::recursionParse($r, $errors);
            }
        }
        return $errors;
    }

    /**
     * Get name of format method.
     * @param string $type see class consts.
     * @return string name of format method.
     * @throws \Exception Bad response type "%s"
     */
    protected static function getMethod($type)
    {
        $method = sprintf('as%s', $type);
        if (!method_exists(static::class, $method)) {
            throw new \Exception(sprintf('Bad response type "%s".', $type));
        }

        return $method;
    }

    /**
     * @param array $errors
     * @return string
     */
    protected static function asJson(array $errors)
    {
        return json_encode($errors);
    }

    /**
     * @return string
     */
    protected static function asString()
    {
        return 'Not implemented';
    }
}