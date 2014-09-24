<!-- span side-left -->
                <div class="span1">
                    <!--side bar-->
                    <aside class="side-left">
                        <ul class="sidebar">
                            <?php foreach ($list_modules as $module) {
                                    if($module['type']=='l'){
                                        if (strlen($module['parent'])<=0){ ?>
                            <li>
                                <a href="<?php echo $module['url']; ?>" title="<?php echo $module['Module']; ?>">
                                    <div class="helper-font-24">
                                        <i class="<?php echo $module['class'];?>"></i>
                                    </div>
                                    <span class="sidebar-text"><?php echo $module['Module']; ?></span>
                                </a>
                            <?php
                                        }
                                        $sub = 0;
                                        foreach($list_modules as $subs) {
                                            if ($module['id_Module'] == $subs['parent']){
                                                $sub++;
                                            }
                                        }
                                        if($sub>0){ ?>
                                <ul class="sub-sidebar-form corner-top shadow-white">
                                <?php    
                                            foreach($list_modules as $subm) {
                                                if ($module['id_Module'] == $subm['parent']){ ?>
                                
                                    <li>
                                        <a href="<?php echo $subm['url']; ?>" title="form element" class="corner-all">
                                            <span class="sidebar-text"><?php echo $subm['Module']; ?></span>
                                        </a>
                                    </li>
                                <?php   
                                                }
                                            } ?>
                                </ul>
                                <?php        
                                        } 
                                    }
                                }   ?>
                            </li>
                        </ul>
                    </aside><!--/side bar -->
                </div>
<!-- span side-left -->