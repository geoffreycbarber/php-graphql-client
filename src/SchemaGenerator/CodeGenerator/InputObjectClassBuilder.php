<?php

namespace GraphQL\SchemaGenerator\CodeGenerator;

use GraphQL\SchemaGenerator\CodeGenerator\CodeFile\ClassFile;
use GraphQL\Util\StringLiteralFormatter;

/**
 * Class InputObjectClassBuilder
 *
 * @package GraphQL\SchemaGenerator\CodeGenerator
 */
class InputObjectClassBuilder extends ObjectClassBuilder
{
    /**
     * SchemaObjectBuilder constructor.
     *
     * @param string $writeDir
     * @param string $objectName
     */
    public function __construct(string $writeDir, string $objectName)
    {
        $className = $objectName . 'InputObject';

        $this->classFile = new ClassFile($writeDir, $className);
        $this->classFile->setNamespace('GraphQL\\SchemaObject');
        $this->classFile->extendsClass('InputObject');
    }

    /**
     * @param string $argumentName
     */
    public function addScalarValue(string $argumentName)
    {
        $upperCamelCaseArg = StringLiteralFormatter::formatUpperCamelCase($argumentName);
        $this->addProperty($argumentName);
        $this->addSimpleSetter($argumentName, $upperCamelCaseArg);
    }

    /**
     * @param string $argumentName
     * @param string $typeName
     */
    public function addListValue(string $argumentName, string $typeName)
    {
        $upperCamelCaseArg = StringLiteralFormatter::formatUpperCamelCase($argumentName);
        $this->addProperty($argumentName);
        $this->addListSetter($argumentName, $upperCamelCaseArg, $typeName);
    }

    /**
     * @param string $argumentName
     * @param string $typeName
     */
    public function addInputObjectValue(string $argumentName, string $typeName)
    {
        $typeName .= 'InputObject';
        $upperCamelCaseArg = StringLiteralFormatter::formatUpperCamelCase($argumentName);
        $this->addProperty($argumentName);
        $this->addInputObjectSetter($argumentName, $upperCamelCaseArg, $typeName);
    }

    /**
     * @return void
     */
    public function build(): void
    {
        $this->classFile->writeFile();
    }
}