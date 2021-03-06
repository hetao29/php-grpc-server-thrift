<?php
namespace Test\HelloThrift;

/**
 * Autogenerated by Thrift Compiler (0.15.0)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 *  @generated
 */
use Thrift\Base\TBase;
use Thrift\Type\TType;
use Thrift\Type\TMessageType;
use Thrift\Exception\TException;
use Thrift\Exception\TProtocolException;
use Thrift\Protocol\TProtocol;
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Exception\TApplicationException;

class Response
{
    static public $isValidate = false;

    static public $_TSPEC = array(
        1 => array(
            'var' => 'number',
            'isRequired' => false,
            'type' => TType::I32,
        ),
        2 => array(
            'var' => 'bigNumber',
            'isRequired' => false,
            'type' => TType::I64,
        ),
        3 => array(
            'var' => 'decimals',
            'isRequired' => false,
            'type' => TType::DOUBLE,
        ),
        4 => array(
            'var' => 'name',
            'isRequired' => false,
            'type' => TType::STRING,
        ),
    );

    /**
     * @var int
     */
    public $number = 10;
    /**
     * @var int
     */
    public $bigNumber = null;
    /**
     * @var double
     */
    public $decimals = null;
    /**
     * @var string
     */
    public $name = "thrifty";

    public function __construct($vals = null)
    {
        if (is_array($vals)) {
            if (isset($vals['number'])) {
                $this->number = $vals['number'];
            }
            if (isset($vals['bigNumber'])) {
                $this->bigNumber = $vals['bigNumber'];
            }
            if (isset($vals['decimals'])) {
                $this->decimals = $vals['decimals'];
            }
            if (isset($vals['name'])) {
                $this->name = $vals['name'];
            }
        }
    }

    public function getName()
    {
        return 'Response';
    }


    public function read($input)
    {
        $xfer = 0;
        $fname = null;
        $ftype = 0;
        $fid = 0;
        $xfer += $input->readStructBegin($fname);
        while (true) {
            $xfer += $input->readFieldBegin($fname, $ftype, $fid);
            if ($ftype == TType::STOP) {
                break;
            }
            switch ($fid) {
                case 1:
                    if ($ftype == TType::I32) {
                        $xfer += $input->readI32($this->number);
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                case 2:
                    if ($ftype == TType::I64) {
                        $xfer += $input->readI64($this->bigNumber);
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                case 3:
                    if ($ftype == TType::DOUBLE) {
                        $xfer += $input->readDouble($this->decimals);
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                case 4:
                    if ($ftype == TType::STRING) {
                        $xfer += $input->readString($this->name);
                    } else {
                        $xfer += $input->skip($ftype);
                    }
                    break;
                default:
                    $xfer += $input->skip($ftype);
                    break;
            }
            $xfer += $input->readFieldEnd();
        }
        $xfer += $input->readStructEnd();
        return $xfer;
    }

    public function write($output)
    {
        $xfer = 0;
        $xfer += $output->writeStructBegin('Response');
        if ($this->number !== null) {
            $xfer += $output->writeFieldBegin('number', TType::I32, 1);
            $xfer += $output->writeI32($this->number);
            $xfer += $output->writeFieldEnd();
        }
        if ($this->bigNumber !== null) {
            $xfer += $output->writeFieldBegin('bigNumber', TType::I64, 2);
            $xfer += $output->writeI64($this->bigNumber);
            $xfer += $output->writeFieldEnd();
        }
        if ($this->decimals !== null) {
            $xfer += $output->writeFieldBegin('decimals', TType::DOUBLE, 3);
            $xfer += $output->writeDouble($this->decimals);
            $xfer += $output->writeFieldEnd();
        }
        if ($this->name !== null) {
            $xfer += $output->writeFieldBegin('name', TType::STRING, 4);
            $xfer += $output->writeString($this->name);
            $xfer += $output->writeFieldEnd();
        }
        $xfer += $output->writeFieldStop();
        $xfer += $output->writeStructEnd();
        return $xfer;
    }
}
