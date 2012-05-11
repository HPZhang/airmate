<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $id_customer
 * @property integer $id_product
 * @property string $name
 * @property string $num_phone
 * @property string $num_card
 * @property string $num_product
 * @property string $num_flow
 * @property string $address
 * @property string $province
 * @property string $city
 * @property string $date_add
 */
class Customer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Customer the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array(
                'num_product, address, province, city',
                'filter',
                'filter'                =>  'strip_tags'
            ),

            array(
                'num_product, address, province, city',
                'filter',
                'filter'                =>  array($obj = new CHtmlPurifier(), 'purify')
            ),

            array(
                'name, num_phone, num_card, num_product, num_flow, address, province, city',
                'filter',
                'filter'                =>  'trim'
            ),

			array(
                'id_product, name, num_phone, num_card, num_product, num_flow, address, province, city',
                'required',
                'message'               =>  '{attribute}不能为空！'
            ),

			array(
                'id_product',
                'numerical',
                'skipOnError'           =>  true,
                'integerOnly'           =>  true,
                'min'                   =>  0,
                'max'                   =>  500
            ),

            array(
                'name',
                'match',
                'skipOnError'           =>  true,
                'pattern'               =>  '/^([\x{4e00}-\x{9fcb}]{2,8}|[a-z\s]{2,32})$/ui',
                'message'               =>  '{attribute}格式为2-8个中文或者2-32个空格、字母！'
            ),

            array(
                'num_phone',
                'match',
                'skipOnError'           =>  true,
                'pattern'               =>  '/^(13|14|15|18)\d{9}$/',
                'message'               =>  '{attribute}格式为11个数字！'
            ),

            array(
                'num_card',
                'match',
                'skipOnError'           =>  true,
                'pattern'               =>  '/^[0-9a-z]{14}$/',
                'message'               =>  '{attribute}格式为14个数字、字母组合！'
            ),

            array(
                'num_card',
                'exist',
                'skipOnError'           =>  true,
                'className'             =>  'Card',
                'attributeName'         =>  'num_card',
                'message'               =>  '{attribute}不存在！'
            ),

            array(
                'num_card',
                'unique',
                'skipOnError'           =>  true,
                'className'             =>  'Customer',
                'attributeName'         =>  'num_card',
                'message'               =>  '{attribute}\'{value}\'已被使用！'
            ),

            /*array(
                'num_product',
                'match',
                'skipOnError'           =>  true,
                'pattern'               =>  '/^[0-9a-z\-]{2,32}$/i',
                'message'               =>  '{attribute}格式为2-32个数字、字母、横杠！'
            ),

            array(
                'num_product',
                'unique',
                'skipOnError'           =>  true,
                'className'             =>  'Customer',
                'attributeName'         =>  'num_product',
                'message'               =>  '{attribute}已被使用过！'
            ),*/

            array(
                'num_flow',
                'match',
                'pattern'               =>  '/^[0-9A-Z]{15,18}$/',
                'skipOnError'           =>  true,
                'message'               =>  '{attribute}格式为15-18个数字、大写字母！'
            ),

            array(
                'num_flow',
                'unique',
                'skipOnError'           =>  true,
                'className'             =>  'Customer',
                'attributeName'         =>  'num_flow',
                'message'               =>  '{attribute}{value}已被使用过！'
            ),

            array(
                'address',
                'length',
                'skipOnError'           =>  true,
                'min'                   =>  10,
                'tooShort'              =>  '{attribute}不能少于{min}个字符！',
                'max'                   =>  255,
                'tooLong'               =>  '{attribute}不能超过{max}个字符！'
            ),

            array(
                'province',
                'match',
                'skipOnError'           =>  true,
                'pattern'               =>  '/^[\x{4e00}-\x{9fcb}]{2,3}$/u',
                'message'               =>  '{attribute}格式为2-3个中文字符！'
            ),

            array(
                'city',
                'match',
                'skipOnError'           =>  true,
                'pattern'               =>  '/^[\x{4e00}-\x{9fcb}]{2,4}$/u',
                'message'               =>  '{attribute}格式为2-4个中文字符！'
            ),

			array(
                'date_add',
                'default',
                'value'                 =>  date('Y-m-d H:i:s')
            )
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'product'               =>  array(self::HAS_ONE, 'Product', array('id_product' => 'id_product'))
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name'                  =>  '姓名',
			'num_phone'             =>  '手机号码',
			'num_card'              =>  '卡片号码',
			'num_product'           =>  '产品型号',
			'num_flow'              =>  '产品流水号',
			'address'               =>  '联系地址',
            'province'              =>  '省份名',
            'city'                  =>  '城市名'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_customer',$this->id_customer);
		$criteria->compare('id_product',$this->id_product);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('num_phone',$this->num_phone,true);
		$criteria->compare('num_card',$this->num_card,true);
		$criteria->compare('num_product',$this->num_product,true);
		$criteria->compare('num_flow',$this->num_flow,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('date_add',$this->date_add,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}