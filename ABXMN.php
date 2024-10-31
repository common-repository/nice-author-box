<?php

/**
 * 
 * @author pramodc <pramod@crawlcenter.com>
 */

class ABXMN
{

    private $escAbxBgcl;
    private $escAbxBrdCl;
    private $escAbxGp;
    private $escAbxGrBr;
    private $escAbxPosn;
    private $escAbxHd;
    private $escAbxpdtp;
    private $escAbxpdbt;
    private $escAbxpdrt;
    private $escAbxpdlft;
    private $escAbxLnk;
    private $escAbxLnkTb;
    private $escAbxHdFt;
    private $ecsAbxDsFt;
    private $escAbxLnkClr;
    private $escAbxDescClr;
    private $escAbxHdStl;

    function __construct()
    {
        if (sanitize_text_field($_POST['abx_usd']) == 'yes') {
            $this->update_abx_cstopt();
            $this->abx_sv_cst_data();
        }
        add_action('admin_enqueue_scripts', [$this, 'abx_admn_scrpts']);
        add_action('wp_enqueue_scripts', [$this, 'abx_nadmn_scrpts']);
    }

    function update_abx_cstopt()
    {
        if (get_option("abx_cstyn") == null) {
            add_option("abx_cstyn", "yes");
        }
    }

    function abx_admn_scrpts()
    {
        wp_enqueue_style('prscp', plugins_url('css/abxast.css', __FILE__));
    }

    function abx_nadmn_scrpts()
    {
        wp_enqueue_style('prscp', plugins_url('css/abxnast.css', __FILE__));
    }

    function abx_bld_pg()
    {
        add_action('admin_menu', [$this, 'abx_bld_npfn']);
    }

    function abx_bld_npfn()
    {
        add_menu_page(
            'Nice Author Box',
            'Nice Author Box',
            'manage_options',
            'abx-pg',
            [$this, 'abx_pgn_htm']
        );
    }

    function abx_pgn_htm()
    {
        $this->load_abx_cstdt();
        echo '<div class="wrap">';
        echo '<form class="abx_mn" action="" method="post"> ';

        echo '<div class="abx_cl">';
        echo '<div class="abx_rw">';
        echo '<h1>Nice Author Box</h1>';
        echo '</div>';

        echo '<div class="abx_rw abx_mtb1">';
        echo '<div class="abx_c25p">';
        echo '<label for ="abx_abxbg">Author Box background color</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<input type="color" id="abx_abxbg" name="abx_abxbg" value="' . esc_attr($this->escAbxBgcl) . '"></input>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw">';
        echo '<div class="abx_c25p">';
        echo '<label for ="abx_abxbrc">Author Box border color</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<input type="color" id="abx_abxbrc" name="abx_abxbrc" value="' . esc_attr($this->escAbxBrdCl) . '"></input>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw abx_mtb1">';
        echo '<div class="abx_c25p">';
        echo '<label for="abx_grrl">Gravatar position</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<select id="abx_grrl" name="abx_grrl">';
        if ($this->escAbxGp == 'Right') {
            echo '<option selected>Right</option>';
            echo '<option>Left</option>';
        } else {
            echo '<option selected>Left</option>';
            echo '<option>Right</option>';
        }

        echo '</select>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw">';
        echo '<div class="abx_c25p">';
        echo '<label for="abx_grbrcl">Add border to gravatar</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<select id="abx_grbrcl" name="abx_grbrcl">';
        if ($this->escAbxGrBr == 'Yes') {
            echo '<option selected>Yes</option>';
            echo '<option>No</option>';
        } else {
            echo '<option>Yes</option>';
            echo '<option selected>No</option>';
        }
        echo '</select>';
        echo '</div>';
        echo '</div>';


        echo '<div class="abx_rw abx_mtb1">';
        echo '<div class="abx_c25p">';
        echo '<label for="abx_abxpsn">Author box position</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<select id="abx_abxpsn" name="abx_abxpsn">';
        if ($this->escAbxPosn == 'Above post') {
            echo '<option selected>Above post</option>';
            echo '<option>Below post</option>';
        } else {
            echo '<option selected>Below post</option>';
            echo '<option>Above post</option>';
        }
        echo '</select>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw">';
        echo '<div class="abx_c25p">';
        echo '<label for ="abx_abxhd">Author box heading</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<input type="text" id="abx_abxhd" name="abx_abxhd" value="' . esc_attr($this->escAbxHd) . '"></input>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw abx_mtb1">';
        echo '<div class="abx_c25p">';
        echo '<label for ="abx_abxpdtp">Author box top padding</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<input type="text" id="abx_abxpdtp" name="abx_abxpdtp" value="' . esc_attr($this->escAbxpdtp) . '"></input>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw">';
        echo '<div class="abx_c25p">';
        echo '<label for ="abx_abxpdbt">Author box bottom padding</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<input type="text" id="abx_abxpdbt" name="abx_abxpdbt" value="' . esc_attr($this->escAbxpdbt) . '"></input>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw abx_mtb1">';
        echo '<div class="abx_c25p">';
        echo '<label for ="abx_abxpdrt">Author box right padding</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<input type="text" id="abx_abxpdrt" name="abx_abxpdrt" value="' . esc_attr($this->escAbxpdrt) . '"></input>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw">';
        echo '<div class="abx_c25p">';
        echo '<label for ="abx_abxpdlft">Author box left padding</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<input type="text" id="abx_abxpdlft" name="abx_abxpdlft" value="' . esc_attr($this->escAbxpdlft) . '"></input>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw abx_mtb1">';
        echo '<div class="abx_c25p">';
        echo '<label for="abx_abxlnk">Show author box link</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<select id="abx_abxlnk" name="abx_abxlnk">';
        if ($this->escAbxLnk == 'Yes') {
            echo '<option selected>Yes</option>';
            echo '<option>No</option>';
        } else {
            echo '<option selected>No</option>';
            echo '<option>Yes</option>';
        }
        echo '</select>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw">';
        echo '<div class="abx_c25p">';
        echo '<label for="abx_abxlnktb">Open link in</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<select id="abx_abxlnktb" name="abx_abxlnktb">';
        if ($this->escAbxLnkTb == 'New tab') {
            echo '<option selected>New tab</option>';
            echo '<option>Same tab</option>';
        } else {
            echo '<option selected>Same tab</option>';
            echo '<option>New tab</option>';
        }
        echo '</select>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw abx_mtb1">';
        echo '<div class="abx_c25p">';
        echo '<label for ="abx_abxlnkclr">Author link color</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<input type="color" id="abx_abxlnkclr" name="abx_abxlnkclr" value="' . esc_attr($this->escAbxLnkClr) . '"></input>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw">';
        echo '<div class="abx_c25p">';
        echo '<label for="abx_abxhdft">Author Box heading font</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<input id="abx_abxhdft" name="abx_abxhdft" value="' . esc_attr($this->escAbxHdFt) . '"></input>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw abx_mtb1">';
        echo '<div class="abx_c25p">';
        echo '<label for="abx_abxdsft">Author Box description font</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<input id="abx_abxdsft" name="abx_abxdsft" value="' . esc_attr($this->ecsAbxDsFt) . '"></input>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw">';
        echo '<div class="abx_c25p">';
        echo '<label for="abx_abxdscclr">Author Box description color</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<input type="color" id="abx_abxdscclr" name="abx_abxdscclr" value="' .esc_attr($this->escAbxDescClr) . '"></input>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw abx_mtb1">';
        echo '<div class="abx_c25p">';
        echo '<label for="abx_abxlhdstl">Author box heading style</label>';
        echo '</div>';
        echo '<div class="abx_c75p">';
        echo '<select id="abx_abxlhdstl" name="abx_abxlhdstl">';
        if ($this->escAbxHdStl == 'Underline text') {
            echo '<option selected>Underline text</option>';
            echo '<option>Bold font</option>';
            echo '<option>Overline text</option>';
        } else if($this->escAbxHdStl == 'Bold font') {
            echo '<option selected>Bold font</option>';
            echo '<option>Underline text</option>';
            echo '<option>Overline text</option>';
        } else if($this->escAbxHdStl == 'Overline text'){
            echo '<option selected>Overline text</option>';
            echo '<option>Underline text</option>';
            echo '<option>Bold font</option>';
        }
        echo '</select>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw">';
        echo '<div class="abx_c100p">';
        echo '<input id="abx_usd" name="abx_usd" type="hidden" value="yes"></input>';
        echo '</div>';
        echo '</div>';

        echo '<div class="abx_rw">';
        echo    submit_button(__("Save Settings", "textdomain"));
        echo '</div>';

        echo '</div>';
        echo '</form>';
        echo '</div>';
    }

    function abx_sv_cst_data()
    {
        $arrd = [];

        $this->escAbxBgcl = sanitize_text_field($_POST['abx_abxbg']);
        $this->escAbxBrdCl = sanitize_text_field($_POST['abx_abxbrc']);
        $this->escAbxGp = sanitize_text_field($_POST['abx_grrl']);
        $this->escAbxGrBr = sanitize_text_field($_POST['abx_grbrcl']);
        $this->escAbxPosn = sanitize_text_field($_POST['abx_abxpsn']);
        $this->escAbxHd = sanitize_text_field($_POST['abx_abxhd']);
        $this->escAbxpdtp = sanitize_text_field($_POST['abx_abxpdtp']);
        $this->escAbxpdbt = sanitize_text_field($_POST['abx_abxpdbt']);
        $this->escAbxpdrt = sanitize_text_field($_POST['abx_abxpdrt']);
        $this->escAbxpdlft = sanitize_text_field($_POST['abx_abxpdlft']);
        $this->escAbxLnk = sanitize_text_field($_POST['abx_abxlnk']);
        $this->escAbxLnkTb = sanitize_text_field($_POST['abx_abxlnktb']);
        $this->escAbxHdFt = sanitize_text_field($_POST['abx_abxhdft']);
        $this->ecsAbxDsFt = sanitize_text_field($_POST['abx_abxdsft']);
        $this->escAbxLnkClr = sanitize_text_field($_POST['abx_abxlnkclr']);
        $this->escAbxDescClr = sanitize_text_field($_POST['abx_abxdscclr']);
        $this->escAbxHdStl = sanitize_text_field($_POST['abx_abxlhdstl']);

        $arrd = array(
            "abx_abxbg" => $this->escAbxBgcl,
            "abx_abxbrc" => $this->escAbxBrdCl,
            "abx_grrl" => $this->escAbxGp,
            "abx_grbrcl" => $this->escAbxGrBr,
            "abx_abxpsn" => $this->escAbxPosn,
            "abx_abxhd" => $this->escAbxHd,
            "abx_abxpdtp" => $this->escAbxpdtp,
            "abx_abxpdbt" => $this->escAbxpdbt,
            "abx_abxpdrt" => $this->escAbxpdrt,
            "abx_abxpdlft" => $this->escAbxpdlft,
            "abx_abxlnk" => $this->escAbxLnk,
            "abx_abxlnktb" => $this->escAbxLnkTb,
            "abx_abxhdft" => $this->escAbxHdFt,
            "abx_abxdsft" => $this->ecsAbxDsFt,
            "abx_abxlnkclr" => $this->escAbxLnkClr,
            "abx_abxdscclr" => $this->escAbxDescClr,
            "abx_abxlhdstl" => $this->escAbxHdStl,
        );

        if (get_option("abx_cstms") == null) {
            add_option("abx_cstms", json_encode($arrd));
        } else {
            update_option("abx_cstms", json_encode($arrd));
        }
    }

    function load_abx_cstdt()
    {
        if (get_option("abx_cstyn", true) == 'yes') {
            $arrd = json_decode(get_option("abx_cstms", true));
            foreach ($arrd as $key => $value) {
                switch ($key) {
                    case "abx_abxbg":
                        $this->escAbxBgcl = $value;
                        break;
                    case  "abx_abxbrc":
                        $this->escAbxBrdCl = $value;
                        break;
                    case "abx_grrl":
                        $this->escAbxGp = $value;
                        break;
                    case "abx_grbrcl":
                        $this->escAbxGrBr = $value;
                        break;
                    case "abx_abxpsn":
                        $this->escAbxPosn = $value;
                        break;
                    case "abx_abxhd":
                        $this->escAbxHd = $value;
                        break;
                    case "abx_abxpdtp":
                        $this->escAbxpdtp = $value;
                        break;
                    case "abx_abxpdbt":
                        $this->escAbxpdbt = $value;
                        break;
                    case "abx_abxpdrt":
                        $this->escAbxpdrt = $value;
                        break;
                    case "abx_abxpdlft":
                        $this->escAbxpdlft = $value;
                        break;
                    case "abx_abxlnk":
                        $this->escAbxLnk = $value;
                        break;
                    case "abx_abxlnktb":
                        $this->escAbxLnkTb = $value;
                        break;
                    case "abx_abxhdft":
                        $this->escAbxHdFt = $value;
                        break;
                    case "abx_abxdsft":
                        $this->ecsAbxDsFt = $value;
                        break;
                    case "abx_abxlnkclr":
                        $this->escAbxLnkClr = $value;
                        break;
                    case "abx_abxdscclr":
                        $this->escAbxDescClr = $value;
                        break;
                    case "abx_abxlhdstl":
                        $this->escAbxHdStl = $value;
                        break;
                }
            }
        }
    }
    function abx_bld_ab($content)
    {
        global $post;
        $this->load_abx_cstdt();
        if (isset($this->escAbxBrdCl)) {
            $str = '<div class="abx_mn" style="background-color:' . $this->escAbxBgcl . ';padding-top:' . $this->escAbxpdtp . 'rem;padding-bottom:' . $this->escAbxpdbt . 'rem;padding-left:' . $this->escAbxpdlft . 'rem;padding-right:' . $this->escAbxpdrt . 'rem; border-style:solid; border-width:thin;border-color:' . $this->escAbxBrdCl . ';">';
        } else {
            $str = '<div class="abx_mn" style="background-color:' . $this->escAbxBgcl . ';padding-top:' . $this->escAbxpdtp . 'rem;padding-bottom:' . $this->escAbxpdbt . 'rem;padding-left:' . $this->escAbxpdlft . 'rem;padding-right:' . $this->escAbxpdrt . 'rem;">';
        }
        $str = $str . '<div class="abx_cl">';
        $str = $str . '<div class="abx_rw">';

        if ($this->escAbxGp == 'Left') {
            $str = $str . '<div class="abx_c20p" style="order:0;">';
        } else {
            $str = $str . '<div class="abx_c20p" style="order:1;">';
        }
        $str = $str . '<img src="' . get_avatar_url(get_the_author_meta('user_email')) . '" style="float:' . strtolower($this->escAbxGp) . ';"/>';
        $str = $str . '</div>';

        if ($this->escAbxGp == 'Left') {
            $str = $str . '<div class="abx_c80p" style="order:1;">';
        } else {
            $str = $str . '<div class="abx_c80p" style="order:0;">';
        }
        $str =  $str . '<div class="abx-hd" style="font-size:' . $this->escAbxHdFt . 'rem;text-decoration:none;">';
        if ($this->escAbxLnk == 'Yes') {
            
            if($this->escAbxLnkTb=='New tab') {
            $str = $str . '<a target="_blank" href="' . get_author_posts_url($post->post_author) . '" style="color:' . $this->escAbxLnkClr . ';">' . $this->escAbxHd . '</a>';
             } else{
                $str = $str . '<a href="' . get_author_posts_url($post->post_author) . '" style="color:' . $this->escAbxLnkClr . ';">' . $this->escAbxHd . '</a>';
             }

        } else {
            $str = $str . $this->escAbxHd;
        }

        if($this->escAbxHdStl=='Underline text') {
            $str = str_replace("text-decoration:none","text-decoration:underline",$str);
                } else if($this->escAbxHdStl =='Bold font'){
                    $str = str_replace("text-decoration:none","text-decoration:none;font-weight:bold",$str);
                }
                else if($this->escAbxHdStl =='Overline text'){
                    $str = str_replace("text-decoration:none","text-decoration:overline",$str);
                }

        $str = $str . '</div>';
        $str = $str . '<div class="abx-bdc" style="font-size:' . $this->ecsAbxDsFt . 'rem;color:'.$this->escAbxDescClr.'">';
        $str = $str . get_the_author_meta("description");
        $str = $str . '</div>';
        $str = $str . '</div>';
        $str = $str . '</div>';

        $str = $str . '</div>';

        $str = $str . "</div>";

        if ($this->escAbxPosn == 'Above post') {
            $str = $str . $content;
        } else {
            $str = $content . $str;
        }
        return $str;
    }

    function abx_bldabx()
    {
        add_filter('the_content', [$this, 'abx_bld_ab']);
    }
}
