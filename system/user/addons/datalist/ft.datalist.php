<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!class_exists('OptionFieldtype')) {
    require_once SYSPATH . 'ee/legacy/fieldtypes/OptionFieldtype.php';
}

class Datalist_ft extends OptionFieldtype
{
    /**
     * @var string[]
     */
    public $info = [
        'name'      => 'DataList',
        'version'   => '0.0.1',
    ];

    /**
     * @return string
     */
    public function display_global_settings()
    {
        return '';
    }

    /**
     * @return array|mixed
     */
    public function save_global_settings()
    {
        return array_merge($this->settings, $_POST);
    }

    /**
     * Sets up the Settings for the specific Field implementation
     * @param $data
     * @return array[]
     */
    public function display_settings($data)
    {
        ee()->lang->loadfile('datalist');
        $settings = $this->getSettingsForm(
            'datalist',
            $data,
            'datalist_options',
            lang('options_field_desc') . lang('datalist_options_desc')
        );

        return ['field_options_datalist' => [
                'label' => 'field_options',
                'group' => 'datalist',
                'settings' => $settings
            ]
        ];
    }

    /**
     * @param $data
     * @return string
     */
    public function display_field($data)
    {
        $options = $this->_get_field_options($data);
        return ee('datalist:FieldService')->generate($this->field_name, $data, $options);
    }

    /**
     * @param $data
     * @return string
     */
    public function grid_display_field($data)
    {
        return $this->display_field($data);
    }

    /**
     * Accept all content types.
     *
     * @param string  The name of the content type
     * @return bool   Accepts all content types
     */
    public function accepts_content_type($name)
    {
        return true;
    }

    /**
     * Update the fieldtype
     *
     * @param string $version The version being updated to
     * @return boolean TRUE if successful, FALSE otherwise
     */
    public function update($version)
    {
        return true;
    }
}
