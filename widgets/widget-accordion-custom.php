<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Widget_Accordion_Custom extends Widget_Base {

    public function get_name()           { return 'accordion_custom'; }
    public function get_title()          { return __( 'Accordion image dynamic', 'custom-widget' ); }
    public function get_icon()           { return 'eicon-accordion'; }
    public function get_categories()     { return [ 'dc_cat' ]; }
    public function get_script_depends() { return [ 'custom-accordion-js' ]; }
    public function get_style_depends()  { return [ 'custom-accordion-css' ]; }

    protected function _register_controls() {

        $repeater = new Repeater();

        $repeater->add_control( 'title_accordion_dc', [
            'label'   => __( 'Titolo', 'custom-widget' ),
            'type'    => Controls_Manager::TEXT,
            'default' => __( 'Title', 'custom-widget' ),
        ]);
        $repeater->add_control( 'text_accordion_dc', [
            'label'   => __( 'Testo', 'custom-widget' ),
            'type'    => Controls_Manager::TEXTAREA,
            'default' => __( 'Text for item', 'custom-widget' ),
            'rows'    => 3,
        ]);
        $repeater->add_control( 'image_accordion_dc', [
            'label'   => __( 'Image', 'custom-widget' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
        ]);
        $repeater->add_control( 'btn_title_accordion_dc', [
            'label'   => __( 'Button Text', 'custom-widget' ),
            'type'    => Controls_Manager::TEXT,
            'default' => __( 'Discover our', 'custom-widget' ),
        ]);
        $repeater->add_control( 'btn_url_accordion_dc', [
            'label'       => esc_html__( 'Link', 'textdomain' ),
            'type'        => Controls_Manager::URL,
            'options'     => [ 'url', 'is_external', 'nofollow' ],
            'label_block' => true,
        ]);

        $this->start_controls_section( 'section_items_accordion_dc', [
            'label' => __( 'Items', 'custom-widget' ),
        ]);
        $this->add_control( 'items_accordion_dc', [
            'label'       => __( 'Items accordion', 'custom-widget' ),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'default'     => [
                [ 'title_accordion_dc' => 'Lorem ipsum dolor', 'text_accordion_dc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin finibus consequat interdum. Etiam facilisis, ex ut tincidunt pharetra, mi lacus maximus arcu, a euismod justo justo eu magna. Integer cursus a elit id aliquam. Aenean a nisi scelerisque sapien posuere molestie sit amet sit amet sapien. Morbi vel efficitur nisi, a auctor velit. Aliquam laoreet nisi nec enim laoreet aliquet. Aliquam mauris arcu, accumsan nec nunc at, fringilla cursus libero.' ],
                [ 'title_accordion_dc' => 'Lorem ipsum dolor', 'text_accordion_dc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin finibus consequat interdum. Etiam facilisis, ex ut tincidunt pharetra, mi lacus maximus arcu, a euismod justo justo eu magna. Integer cursus a elit id aliquam. Aenean a nisi scelerisque sapien posuere molestie sit amet sit amet sapien. Morbi vel efficitur nisi, a auctor velit. Aliquam laoreet nisi nec enim laoreet aliquet. Aliquam mauris arcu, accumsan nec nunc at, fringilla cursus libero.' ],
            ],
            'title_field' => '{{{ title_accordion_dc }}}',
        ]);
        $this->end_controls_section();

        /* STYLE: Items */
        $this->start_controls_section( 'style_tab_items_accordion_dc', [
            'label' => esc_html__( 'Items', 'textdomain' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control( 'padding_item_accordion_dc', [
            'label'      => esc_html__( 'Padding', 'textdomain' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
            'selectors'  => [ '{{WRAPPER}} .accordion-dc-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            'default'    => [ 'top' => 0, 'right' => 20, 'bottom' => 20, 'left' => 20, 'unit' => 'px', 'isLinked' => true ],
        ]);
        $this->add_group_control( \Elementor\Group_Control_Border::get_type(), [
            'name'     => 'border_item_accordion_dc',
            'selector' => '{{WRAPPER}} .accordion-dc-item',
        ]);
        $this->end_controls_section();

        /* STYLE: Immagine */
        $this->start_controls_section( 'style_tab_image_accordion_dc', [
            'label' => esc_html__( 'Immagine', 'textdomain' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_control( 'border_radius_image_accordion_dc', [
            'label'      => esc_html__( 'Border Radius', 'textdomain' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
            'selectors'  => [ '{{WRAPPER}} .accordion-dc-image-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->end_controls_section();
        
        /* STYLE: Titoli */
        $this->start_controls_section( 'style_tab_title_accordion_dc', [
            'label' => esc_html__( 'Titoli', 'textdomain' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name'     => 'title_typography_accordion_dc',
            'selector' => '{{WRAPPER}} .accordion-dc-title',
            'global'   => [ 'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY ],
        ]);
        $this->start_controls_tabs( 'style_title_tabs_accordion_dc' );
        $this->start_controls_tab( 'style_title_normal_accordion_dc', [ 'label' => esc_html__( 'Normal', 'textdomain' ) ]);
        $this->add_control( 'title_color_normal_accordion_dc', [
            'label'     => esc_html__( 'Title Color', 'textdomain' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .accordion-dc-title' => 'color: {{VALUE}}' ],
            'global'    => [ 'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY ],
        ]);
        $this->end_controls_tab();
        $this->start_controls_tab( 'style_title_active_accordion_dc', [ 'label' => esc_html__( 'Active', 'textdomain' ) ]);
        $this->add_control( 'title_color_active_accordion_dc', [
            'label'     => esc_html__( 'Title Color active', 'textdomain' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .accordion-dc-item.is-active .accordion-dc-title' => 'color: {{VALUE}}' ],
        ]);
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control( 'numbers_heading_accordion_dc', [
            'label'     => esc_html__( 'Numeri', 'textdomain' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name'     => 'number_typography_accordion_dc',
            'selector' => '{{WRAPPER}} .accordion-dc-number',
        ]);
        $this->start_controls_tabs( 'style_number_tabs_accordion_dc' );
        $this->start_controls_tab( 'style_number_normal_accordion_dc', [ 'label' => esc_html__( 'Normal', 'textdomain' ) ]);
        $this->add_control( 'number_color_normal_accordion_dc', [
            'label'     => esc_html__( 'Number Color', 'textdomain' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .accordion-dc-number' => 'color: {{VALUE}}' ],
        ]);
        $this->end_controls_tab();
        $this->start_controls_tab( 'style_number_active_accordion_dc', [ 'label' => esc_html__( 'Active', 'textdomain' ) ]);
        $this->add_control( 'number_color_active_accordion_dc', [
            'label'     => esc_html__( 'Number Color active', 'textdomain' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .accordion-dc-item.is-active .accordion-dc-number' => 'color: {{VALUE}}' ],
        ]);
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /* STYLE: Testo */
        $this->start_controls_section( 'style_tab_text_accordion_dc', [
            'label' => esc_html__( 'Testo', 'textdomain' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name'     => 'text_typography_accordion_dc',
            'selector' => '{{WRAPPER}} .accordion-dc-text',
            'global'   => [ 'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT ],
        ]);
        $this->add_control( 'text_color_accordion_dc', [
            'label'     => esc_html__( 'Text Color', 'textdomain' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .accordion-dc-text' => 'color: {{VALUE}}' ],
            'global'    => [ 'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY],
        ]);
        $this->end_controls_section();

        /* STYLE: Bottone */
        $this->start_controls_section( 'style_tab_btn_accordion_dc', [
            'label' => esc_html__( 'Bottone', 'textdomain' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name'     => 'button_typography_accordion_dc',
            'selector' => '{{WRAPPER}} .accordion-dc-btn-link',
            'global'   => [ 'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY ],
        ]);
        $this->start_controls_tabs( 'style_button_tabs_accordion_dc' );
        $this->start_controls_tab( 'style_button_normal_accordion_dc', [ 'label' => esc_html__( 'Normal', 'textdomain' ) ]);
        $this->add_control( 'bg_button_color_normal_accordion_dc', [
            'label'     => esc_html__( 'Button Color', 'textdomain' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .accordion-dc-btn-link' => 'background-color: {{VALUE}}' ],
            'global'   => [ 'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_ACCENT],
        ]);
        $this->add_control( 'text_button_color_normal_accordion_dc', [
            'label'     => esc_html__( 'Text button Color', 'textdomain' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .accordion-dc-btn-link' => 'color: {{VALUE}}' ],
        ]);
        $this->end_controls_tab();
        $this->start_controls_tab( 'style_button_hover_accordion_dc', [ 'label' => esc_html__( 'Hover', 'textdomain' ) ]);
        $this->add_control( 'bg_button_color_hover_accordion_dc', [
            'label'     => esc_html__( 'Button Color hover', 'textdomain' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .accordion-dc-btn-link:hover' => 'background-color: {{VALUE}}' ],
        ]);
        $this->add_control( 'text_button_color_hover_accordion_dc', [
            'label'     => esc_html__( 'Text button Color hover', 'textdomain' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [ '{{WRAPPER}} .accordion-dc-btn-link:hover' => 'color: {{VALUE}}' ],
        ]);
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control( 'padding_button_accordion_dc', [
            'label'      => esc_html__( 'Padding', 'textdomain' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
            'selectors'  => [ '{{WRAPPER}} .accordion-dc-btn-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->add_control( 'radius_button_accordion_dc', [
            'label'      => esc_html__( 'Border radius', 'textdomain' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
            'selectors'  => [ '{{WRAPPER}} .accordion-dc-btn-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
        ]);
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if ( empty( $settings['items_accordion_dc'] ) ) { return; }

        $first             = $settings['items_accordion_dc'][0];
        $first_image_url   = ! empty( $first['image_accordion_dc']['url'] )          ? $first['image_accordion_dc']['url']          : \Elementor\Utils::get_placeholder_image_src();
        $first_btn_url     = ! empty( $first['btn_url_accordion_dc']['url'] )         ? $first['btn_url_accordion_dc']['url']         : '#';
        $first_is_external = ! empty( $first['btn_url_accordion_dc']['is_external'] ) ? ' target="_blank"'                            : '';
        $first_nofollow    = ! empty( $first['btn_url_accordion_dc']['nofollow'] )     ? ' rel="nofollow"'                             : '';
        $first_btn_title   = ! empty( $first['btn_title_accordion_dc'] )              ? $first['btn_title_accordion_dc']              : '';

        // Controlla se almeno un item ha un bottone — serve per decidere se mostrare il wrapper
        $has_any_btn = false;
        foreach ( $settings['items_accordion_dc'] as $item ) {
            if ( ! empty( $item['btn_title_accordion_dc'] ) ) {
                $has_any_btn = true;
                break;
            }
        }

        $counter = 0;
        ?>
        <div class="accordion-dc-widget" data-accordion-id="<?php echo esc_attr( $this->get_id() ); ?>">

            <div class="accordion-dc-left">
                <?php foreach ( $settings['items_accordion_dc'] as $index => $item ) :
                    $counter++;
                    $is_active   = ( 0 === $index );
                    $item_image  = ! empty( $item['image_accordion_dc']['url'] )          ? $item['image_accordion_dc']['url']          : '';
                    $btn_url     = ! empty( $item['btn_url_accordion_dc']['url'] )         ? $item['btn_url_accordion_dc']['url']         : '';
                    $is_external = ! empty( $item['btn_url_accordion_dc']['is_external'] ) ? 'yes'                                        : '';
                    $nofollow    = ! empty( $item['btn_url_accordion_dc']['nofollow'] )     ? 'yes'                                        : '';
                    $btn_title   = ! empty( $item['btn_title_accordion_dc'] )              ? $item['btn_title_accordion_dc']              : '';
                    ?>
                    <div class="accordion-dc-item <?php echo $is_active ? 'is-active' : ''; ?>"
                         data-image="<?php echo esc_url( $item_image ); ?>"
                         data-btn-url="<?php echo esc_url( $btn_url ); ?>"
                         data-btn-external="<?php echo esc_attr( $is_external ); ?>"
                         data-btn-nofollow="<?php echo esc_attr( $nofollow ); ?>"
                         data-btn-title="<?php echo esc_attr( $btn_title ); ?>">

                        <div class="accordion-dc-toggle">
                            <div class="accordion-dc-number"><?php echo str_pad( $counter, 2, '0', STR_PAD_LEFT ); ?></div>
                            <div class="accordion-dc-title"><?php echo esc_html( $item['title_accordion_dc'] ); ?></div>
                        </div>

                        <div class="accordion-dc-text" <?php echo $is_active ? '' : 'style="display:none;"'; ?>>
                            <?php echo wp_kses_post( $item['text_accordion_dc'] ); ?>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

            <div class="accordion-dc-right">
                <div class="accordion-dc-image-wrapper" style="background-image: url('<?php echo esc_url( $first_image_url ); ?>');">
                    <?php if ( $has_any_btn ) : ?>
                        <div class="accordion-dc-btn" <?php echo empty( $first_btn_title ) ? 'style="display:none;"' : ''; ?>>
                            <a class="accordion-dc-btn-link"
                               href="<?php echo esc_url( $first_btn_url ); ?>"<?php echo $first_is_external . $first_nofollow; ?>>
                                <?php echo esc_html( $first_btn_title ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <?php
    }
}
