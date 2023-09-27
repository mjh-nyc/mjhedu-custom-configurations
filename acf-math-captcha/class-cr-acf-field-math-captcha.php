<?php
/**
 * Defines the custom field type class.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * cr_acf_field_math_captcha class.
 */
class cr_acf_field_math_captcha extends \acf_field {
	/**
	 * Controls field type visibilty in REST requests.
	 *
	 * @var bool
	 */
	public $show_in_rest = true;

	/**
	 * Environment values relating to the theme or plugin.
	 *
	 * @var array $env Plugin or theme context such as 'url' and 'version'.
	 */
	private $env;

	/**
	 * Constructor.
	 */
	public function __construct() {
		/**
		 * Field type reference used in PHP and JS code.
		 *
		 * No spaces. Underscores allowed.
		 */
		$this->name = 'math_captcha';

		/**
		 * Field type label.
		 *
		 * For public-facing UI. May contain spaces.
		 */
		$this->label = __( 'Math Captcha', 'mjhedu-custom-configurations' );

		/**
		 * The category the field appears within in the field type picker.
		 */
		$this->category = 'basic'; // basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME

		/**
		 * Field type Description.
		 *
		 * For field descriptions. May contain spaces.
		 */
		$this->description = __( 'Math Captcha Challenge', 'mjhedu-custom-configurations' );

		/**
		 * Field type Doc URL.
		 *
		 * For linking to a documentation page. Displayed in the field picker modal.
		 */
		$this->doc_url = '';

		/**
		 * Field type Tutorial URL.
		 *
		 * For linking to a tutorial resource. Displayed in the field picker modal.
		 */
		$this->tutorial_url = '';

		/**
		 * Defaults for your custom user-facing settings for this field type.
		 */
		$this->defaults = array(
		);

		/**
		 * Strings used in JavaScript code.
		 *
		 * Allows JS strings to be translated in PHP and loaded in JS via:
		 *
		 * ```js
		 * const errorMessage = acf._e("math_captcha", "error");
		 * ```
		 */
		$this->l10n = array(
			'error'	=> __( 'Error! Please enter a higher value', 'mjhedu-custom-configurations' ),
		);
		$this->env = array(
			'url'     => WPMU_PLUGIN_URL.'/mjhedu-custom-configurations/acf-math-captcha/', // URL to the acf-math-captcha directory.
			'version' => '1.0', // Replace this with your theme or plugin version constant.
		);

		/**
		 * Field type preview image.
		 *
		 * A preview image for the field type in the picker modal.
		 */
		$this->preview_image = $this->env['url'] . '/assets/images/field-preview-custom.png';

        //Get numbers and add them up for challenge
        $this->num1 = $this->getRandomNumber();
        $this->num2 = $this->getRandomNumber();
        $this->sum  = $this->num1 + $this->num2;

		parent::__construct();
	}

	/**
	 * Settings to display when users configure a field of this type.
	 *
	 * These settings appear on the ACF “Edit Field Group” admin page when
	 * setting up the field.
	 *
	 * @param array $field
	 * @return void
	 */
	public function render_field_settings( $field ) {

	}

	/**
	 * HTML content to show when a publisher edits the field on the edit screen.
	 *
	 * @param array $field The field settings and values.
	 * @return void
	 */
	public function render_field( $field ) {
		// Display an input field and hidden answer field by converting answer sum into binary
		?>
        <span>
            <?php echo $this->num1 . '+' . $this->num2; ?>?
        </span>
		<input
			type="text"
            id="<?php echo esc_attr($field['id']) ?>"
			name="<?php echo esc_attr($field['name']) ?>"
			value="<?php echo esc_attr($field['value']) ?>"
		/>
        <input type="hidden" name="cr-cache-<?php echo esc_attr($field['id']) ?>" value="<?php echo decbin($this->sum) ?>"/>
		<?php
	}
    /**
     * Get Random number
     *
     * @param int $min
     * @param int $max
     *
     * @return int
     */
    private function getRandomNumber( $min=1, $max=30){
        return rand( $min, $max );
    }
    /**
     * Validate the captcha challenge
     *
     * Callback for validate_value.
     *
     * @return mixed
     */
    function validate_value( $valid, $value, $field, $input_name ) {

        // Bail early if value is already invalid.
        if( $valid !== true ) {
            return $valid;
        }
        //Check the field type and of it has hidden captcha challenge answer
        if($field['type']=='math_captcha' && !empty($_POST['cr-cache-'.$field['prefix'].'-'.$field['key']])){
            //Fetch captcha challenge answer converting in back from binary to decimal
            $captcha_value_challenge_answer = bindec($_POST['cr-cache-'.$field['prefix'].'-'.$field['key']]);
            //Check if values match
            if($captcha_value_challenge_answer != $value){
                return __( 'Please review captcha challenge' );
            }
        }
        return $valid;
    }
}
