<?php
include("main-header.php");
    ?>
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
               
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="accordion" id="accordionExample3" data-toggle-hover="true">
                                <div class="collapse-default">
                                    <div class="card mb-2">
                                        <div class="card-header ">
                                             <a href="javascript:void(0);" onclick="start();">Notify</a>
                                            <?php
                                                $pending_document = check_pending_document('21');
                                                print_r($pending_document);
                                                // insert_notification('3',33,0,$session_user_id,"test rushit") ;
                                                // phpinfo();
                                                // get_notification($session_user_id) ;
                                                // shoot_email($attachment,"hello rushit","test smtp","rushitpatel304@gmail.com","rushitwebteqno304@gmail.com");
                                                // // $setPermissions=setPermissions($service,"1RRwDI3Gy_1d0mO1Y5rtFA2JHXX_gKGLo",'rushitpatel304@gmail.com','owner','user');
                                                // // // var_dump($setPermissions);
                                                // echo "<pre>";
                                                // print_r($service);
                                                // google-drive/1646571402c-optics-223410-98778badd454.p12
                                                // $get_folder=get_folder_files($service,'Database Bkp 2021');
                                                // // removePermission($service, "1RRwDI3Gy_1d0mO1Y5rtFA2JHXX_gKGLo", "11777063357355516558");
                                                // function retrievePermissions($service, $fileId) {
                                                //   try {
                                                //     $permissions = $service->permissions->listPermissions($fileId);
                                                //     return $permissions->getItems();
                                                //   } catch (Exception $e) {
                                                //     print "An error occurred: " . $e->getMessage();
                                                //   }
                                                //   return NULL;
                                                // }

                                                // $retrievePermissions=retrievePermissions($service, "1RRwDI3Gy_1d0mO1Y5rtFA2JHXX_gKGLo"); 
                                                // print_r($retrievePermissions);
                                            ?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

<?php
include("common-js.php");
include("main-footer.php");
 ?>
 <script src="app-assets/js/scripts/components/components-popovers.min.js"></script>
 <script src="app-assets/js/scripts/push/push.min.js"></script>
 <script src="app-assets/js/scripts/push/serviceWorker.min.js"></script>
<script>
    function start(){
        Push.create("Hello world!", {
            body: "How's it hangin'?",
            icon: 'app-assets/images/ico/ico.png',
            timeout: 4000,
            onClick: function () {
                window.focus();
                this.close();
            }
        });
    }
</script>
