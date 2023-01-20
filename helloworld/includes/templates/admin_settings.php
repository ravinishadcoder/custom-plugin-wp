
<div class="wrap">
    <h1>News Settings</h1>
    <form method="post" action="<?php echo admin_url('edit.php?post_type=news&page=news-settings') ?>">
        <?php wp_nonce_field('news-settings-save','news_settings_nonce') ;?>
        <table class='form-table'>
            <tbody>
                <tr>
                    <th><label for="news_related_title">Related News Title</label></th>
                    <td><input id="news_related_title" type="text" name="news_related_title" value="<?php echo esc_attr(get_option('hw_news_related_title','Related News')) ?>"></td>
                </tr>
                <tr>
                    <th><lable for="show_related">Show Related News?</lable></th>
                    <td><input id="show_related" type="checkbox" name="show_related" value="1" <?php checked(get_option('hw_show_related',true)) ?>></td>
                </tr>
                <tr>
                    <th><label for="related_news_amount">Number of Articles</label></th>
                    <td>
                        <select name="related_news_amount" id="related_news_amount">
                            <?php for($i=1;$i<=10;$i++):?>
                                <option value="<?php echo $i; ?>" <?php selected(get_option('hw_related_news_amount',3),$i) ?>><?php echo $i; ?></option>
                                <?php endfor; ?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
        <input type="submit" name="submit" class="button button-primary" value="save changes">
        </p>
    </form>
</div>