<?php defined('_NOAH') or die('Restricted access'); ?>
<?php $friendOrResponseLinksExist = $this->get("responseLink") || $this->get("friendmailLink"); ?>
<div class='template detailsTemplate' id='<?php echo $this->listAndMethod ?>'>
  <table <?php if( !empty($this->tableClass) ) echo "class='$this->tableClass'" ?>>
    <?php if($this->title): ?>
      <caption>
        <span class='title'><?php echo $this->title ?></span>
        <?php if( count($this->headerMethods) ): ?>
          <span class='headermethod'>
            <?php echo implode(" | \n", $this->headerMethods) ?>
          </span>
        <?php endif; ?>
      </caption>
    <?php endif; ?>  
    <tbody>
      <?php for( $i=0, $alt=0, $attrs=array_keys($this->rows); $i<count($this->rows); $i++, $alt=$i%2):
          $row=$this->rows[$attrs[$i]];
          $customCss=@$this->customCss[$attrs[$i]];
      ?>
        <?php foreach( $row as $key=>$value): ?>
          <?php if( $key=='label' ): ?>
            <tr>
              <td class='label<?php if( $this->zebraDetails ) echo $alt ?> <?php echo $customCss ?>'><?php echo $value ?></td>
          <?php elseif( $key=='value' ): ?>
              <td class='cell<?php if( $this->zebraDetails ) echo $alt ?> <?php echo $customCss ?>'><?php echo $value ?></td>
          </tr>
          <?php elseif( $key=='separator' ): ?>
            <tr>
              <td class='separator <?php echo $customCss ?>' colspan='2'><?php echo $value ?></td>
            </tr>  
          <?php elseif( $key=='widecontent' ): ?>
            <tr>
              <td class='cell<?php if( $this->zebraDetails ) echo $alt ?> <?php echo $customCss ?>' colspan='2'><?php echo $value ?></td>
            </tr>  
          <?php elseif( $key=='notable' ): ?>
            </tbody>
              </table>
              <?php echo $value ?>
              <table>
            <tbody>    
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endfor; ?>
      <?php if( $this->pictures ): ?>
        <tr>
          <td class='label<?php if( $this->zebraDetails ) echo $alt ?>'>Pictures</td>
          <td class='cell<?php if( $this->zebraDetails ) echo $alt ?>'>
          <?php foreach( $this->pictures as $picture): ?>
            <?php echo $picture["tag"] ?>
          <?php endforeach; ?>
          </td>
        </tr>
      <?php endif; ?>
      <?php if( $friendOrResponseLinksExist ): ?>
        <tr>
          <td colspan='2' class='friendAndResponse'>
            <table>
              <tr>
                <?php if( $this->get("responseLink") ): ?>
                  <td style='padding-right: 20px; text-align: right;'><div class='friend'><?php echo $this->get("responseLink") ?></div></td>
                <?php endif; ?>
                <?php if( $this->get("friendmailLink") ): ?>
                  <td style='padding-left: 20px; text-align: left;'><div class='friend'><?php echo $this->get("friendmailLink") ?></div></td>
                <?php endif; ?>  
              </tr>  
            </table>
          </td>  
        </tr>  
      <?php endif; ?>
      <?php if( $this->detailsMethods ): ?>
        <?php echo $this->detailsMethods ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>  
