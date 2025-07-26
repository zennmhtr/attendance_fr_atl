<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

    <head>
        <title>Scrollspy | Attex - Bootstrap 5 Admin & Dashboard Template</title>
    <?php include 'layouts/title-meta.php'; ?>

    <?php include 'layouts/head-css.php'; ?>
    </head>

    <body>
        <!-- Begin page -->
        <div class="wrapper">

        <?php include 'layouts/menu.php'; ?>

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Attex</a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Extended UI</a></li>
                                        <li class="breadcrumb-item active">Scrollspy</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Scrollspy</h4>
                            </div>
                        </div>
                    </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <nav id="navbar-example2" class="navbar navbar-light bg-light px-3">
                                            <a class="navbar-brand" href="#">Navbar
                                        </nav>
										<div class="row">
                                        <div class="col-lg-6">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="simpleinput" class="form-label">Text</label>
                                                    <input type="text" id="simpleinput" class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="example-email" class="form-label">Email</label>
                                                    <input type="email" id="example-email" name="example-email" class="form-control" placeholder="Email">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="example-password" class="form-label">Password</label>
                                                    <input type="password" id="example-password" class="form-control" value="password">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Show/Hide Password</label>
                                                    <div class="input-group input-group-merge">
                                                        <input type="password" id="password" class="form-control" placeholder="Enter your password">
                                                        <div class="input-group-text" data-password="false">
                                                            <span class="password-eye"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="example-palaceholder" class="form-label">Placeholder</label>
                                                    <input type="text" id="example-palaceholder" class="form-control" placeholder="placeholder">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="example-textarea" class="form-label">Text area</label>
                                                    <textarea class="form-control" id="example-textarea" rows="5"></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="example-readonly" class="form-label">Readonly</label>
                                                    <input type="text" id="example-readonly" class="form-control" readonly="" value="Readonly value">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="example-disable" class="form-label">Disabled</label>
                                                    <input type="text" class="form-control" id="example-disable" disabled="" value="Disabled value">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="example-static" class="form-label">Static control</label>
                                                    <input type="text" readonly class="form-control-plaintext" id="example-static" value="email@example.com">
                                                </div>

                                                <div class="mb-0">
                                                    <label for="example-helping" class="form-label">Helping text</label>
                                                    <input type="text" id="example-helping" class="form-control" placeholder="Helping text">
                                                    <span class="help-block"><small>A block of help text that breaks onto a new line and may extend beyond one line.</small></span>
                                                </div>

                                            </form>
                                        </div> <!-- end col -->

                                        <div class="col-lg-6">
                                            <form>

                                                <div class="mb-3">
                                                    <label for="example-select" class="form-label">Input Select</label>
                                                    <select class="form-select" id="example-select">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="example-multiselect" class="form-label">Multiple Select</label>
                                                    <select id="example-multiselect" multiple class="form-control">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="example-fileinput" class="form-label">Default file input</label>
                                                    <input type="file" id="example-fileinput" class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="example-date" class="form-label">Date</label>
                                                    <input class="form-control" id="example-date" type="date" name="date">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="example-month" class="form-label">Month</label>
                                                    <input class="form-control" id="example-month" type="month" name="month">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="example-time" class="form-label">Time</label>
                                                    <input class="form-control" id="example-time" type="time" name="time">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="example-week" class="form-label">Week</label>
                                                    <input class="form-control" id="example-week" type="week" name="week">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="example-number" class="form-label">Number</label>
                                                    <input class="form-control" id="example-number" type="number" name="number">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="example-color" class="form-label">Color</label>
                                                    <input class="form-control" id="example-color" type="color" name="color" value="#727cf5">
                                                </div>

                                                <div class="mb-0">
                                                    <label for="example-range" class="form-label">Range</label>
                                                    <input class="form-range" id="example-range" type="range" name="range" min="0" max="100">
                                                </div>

                                            </form>
                                        </div> <!-- end col -->
                                    </div>
d card-->
                            </div> <!-- end col -->

                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Example with nested nav</h4>
                                        <p class="text-muted fs-14">Scrollspy also works with nested <code>.nav</code>s.
                                            If a nested <code>.nav</code> is <code>.active</code>, its parents will also be
                                            <code>.active</code>. Scroll the area next to the navbar and watch the active
                                            class change.</p>

                                        <div class="row">
                                            <div class="col-2">
                                                <nav id="navbar-example3" class="h-100 flex-column align-items-stretch pe-4 border-end">
                                                    <nav class="nav nav-pills flex-column">
                                                        <a class="nav-link" href="#item-1">Item 1</a>
                                                        <nav class="nav nav-pills flex-column">
                                                            <a class="nav-link ms-3 my-1" href="#item-1-1">Item 1-1</a>
                                                            <a class="nav-link ms-3 my-1" href="#item-1-2">Item 1-2</a>
                                                        </nav>
                                                        <a class="nav-link" href="#item-2">Item 2</a>
                                                        <a class="nav-link" href="#item-3">Item 3</a>
                                                        <nav class="nav nav-pills flex-column">
                                                            <a class="nav-link ms-3 my-1" href="#item-3-1">Item 3-1</a>
                                                            <a class="nav-link ms-3 my-1" href="#item-3-2">Item 3-2</a>
                                                        </nav>
                                                    </nav>
                                                </nav>
                                            </div>
                                            <div class="col-10">
                                                <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-offset="0" class="scrollspy-example" style="height: 350px;">
                                                    <h4 id="item-1">Item 1</h4>
                                                    <p>Ex consequat commodo adipisicing exercitation aute excepteur
                                                        occaecat ullamco duis aliqua id magna ullamco eu. Do aute
                                                        ipsum ipsum ullamco cillum consectetur ut et aute
                                                        consectetur labore. Fugiat laborum incididunt tempor eu
                                                        consequat enim dolore proident. Qui laborum do non excepteur
                                                        nulla magna eiusmod consectetur in. Aliqua et aliqua officia
                                                        quis et incididunt voluptate non anim reprehenderit
                                                        adipisicing dolore ut consequat deserunt mollit dolore.
                                                        Aliquip nulla enim veniam non fugiat id cupidatat nulla elit
                                                        cupidatat commodo velit ut eiusmod cupidatat elit dolore.
                                                    </p>
                                                    <h5 id="item-1-1">Item 1-1</h5>
                                                    <p>Amet tempor mollit aliquip pariatur excepteur commodo do ea
                                                        cillum commodo Lorem et occaecat elit qui et. Aliquip labore
                                                        ex ex esse voluptate occaecat Lorem ullamco deserunt. Aliqua
                                                        cillum excepteur irure consequat id quis ea. Sit proident
                                                        ullamco aute magna pariatur nostrud labore. Reprehenderit
                                                        aliqua commodo eiusmod aliquip est do duis amet proident
                                                        magna consectetur consequat eu commodo fugiat non quis. Enim
                                                        aliquip exercitation ullamco adipisicing voluptate excepteur
                                                        minim exercitation minim minim commodo adipisicing
                                                        exercitation officia nisi adipisicing. Anim id duis qui
                                                        consequat labore adipisicing sint dolor elit cillum anim et
                                                        fugiat.</p>
                                                    <h5 id="item-1-2">Item 1-2</h5>
                                                    <p>Cillum nisi deserunt magna eiusmod qui eiusmod velit
                                                        voluptate pariatur laborum sunt enim. Irure laboris mollit
                                                        consequat incididunt sint et culpa culpa incididunt
                                                        adipisicing magna magna occaecat. Nulla ipsum cillum eiusmod
                                                        sint elit excepteur ea labore enim consectetur in labore
                                                        anim. Proident ullamco ipsum esse elit ut Lorem eiusmod
                                                        dolor et eiusmod. Anim occaecat nulla in non consequat
                                                        eiusmod velit incididunt.</p>
                                                    <h4 id="item-2">Item 2</h4>
                                                    <p>Quis magna Lorem anim amet ipsum do mollit sit cillum
                                                        voluptate ex nulla tempor. Laborum consequat non elit enim
                                                        exercitation cillum aliqua consequat id aliqua. Esse ex
                                                        consectetur mollit voluptate est in duis laboris ad sit
                                                        ipsum anim Lorem. Incididunt veniam velit elit elit veniam
                                                        Lorem aliqua quis ullamco deserunt sit enim elit aliqua esse
                                                        irure. Laborum nisi sit est tempor laborum mollit labore
                                                        officia laborum excepteur commodo non commodo dolor
                                                        excepteur commodo. Ipsum fugiat ex est consectetur ipsum
                                                        commodo tempor sunt in proident.</p>
                                                    <h4 id="item-3">Item 3</h4>
                                                    <p>Quis anim sit do amet fugiat dolor velit sit ea ea do
                                                        reprehenderit culpa duis. Nostrud aliqua ipsum fugiat minim
                                                        proident occaecat excepteur aliquip culpa aute tempor
                                                        reprehenderit. Deserunt tempor mollit elit ex pariatur
                                                        dolore velit fugiat mollit culpa irure ullamco est ex
                                                        ullamco excepteur.</p>
                                                    <h5 id="item-3-1">Item 3-1</h5>
                                                    <p>Deserunt quis elit Lorem eiusmod amet enim enim amet minim
                                                        Lorem proident nostrud. Ea id dolore anim exercitation aute
                                                        fugiat labore voluptate cillum do laboris labore. Ex velit
                                                        exercitation nisi enim labore reprehenderit labore nostrud
                                                        ut ut. Esse officia sunt duis aliquip ullamco tempor eiusmod
                                                        deserunt irure nostrud irure. Ullamco proident veniam
                                                        laboris ea consectetur magna sunt ex exercitation aliquip
                                                        minim enim culpa occaecat exercitation. Est tempor excepteur
                                                        aliquip laborum consequat do deserunt laborum esse eiusmod
                                                        irure proident ipsum esse qui.</p>
                                                    <h5 id="item-3-2">Item 3-2</h5>
                                                    <p>Labore sit culpa commodo elit adipisicing sit aliquip elit
                                                        proident voluptate minim mollit nostrud aute reprehenderit
                                                        do. Mollit excepteur eu Lorem ipsum anim commodo sint labore
                                                        Lorem in exercitation velit incididunt. Occaecat consectetur
                                                        nisi in occaecat proident minim enim sunt reprehenderit
                                                        exercitation cupidatat et do officia. Aliquip consequat ad
                                                        labore labore mollit ut amet. Sit pariatur tempor proident
                                                        in veniam culpa aliqua excepteur elit magna fugiat eiusmod
                                                        amet officia.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Example with list-group</h4>
                                        <p class="text-muted fs-14">Scrollspy also works with nested <code>.nav</code>s.
                                            If a nested <code>.nav</code> is <code>.active</code>, its parents will also be
                                            <code>.active</code>. Scroll the area next to the navbar and watch the active
                                            class change.</p>

                                        <div class="row">
                                            <div class="col-2">
                                                <div id="list-example" class="list-group">
                                                    <a class="list-group-item list-group-item-action active"
                                                        href="#list-item-1">Item 1</a>
                                                    <a class="list-group-item list-group-item-action"
                                                        href="#list-item-2">Item 2</a>
                                                    <a class="list-group-item list-group-item-action"
                                                        href="#list-item-3">Item 3</a>
                                                    <a class="list-group-item list-group-item-action"
                                                        href="#list-item-4">Item 4</a>
                                                </div>
                                            </div>
                                            <div class="col-10">
                                                <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0"
                                                    class="scrollspy-example">
                                                    <h4 id="list-item-1">Item 1</h4>
                                                    <p>Ex consequat commodo adipisicing exercitation aute excepteur
                                                        occaecat ullamco duis aliqua id magna ullamco eu. Do aute
                                                        ipsum ipsum ullamco cillum consectetur ut et aute
                                                        consectetur labore. Fugiat laborum incididunt tempor eu
                                                        consequat enim dolore proident. Qui laborum do non excepteur
                                                        nulla magna eiusmod consectetur in. Aliqua et aliqua officia
                                                        quis et incididunt voluptate non anim reprehenderit
                                                        adipisicing dolore ut consequat deserunt mollit dolore.
                                                        Aliquip nulla enim veniam non fugiat id cupidatat nulla elit
                                                        cupidatat commodo velit ut eiusmod cupidatat elit dolore.
                                                    </p>
                                                    <h4 id="list-item-2">Item 2</h4>
                                                    <p>Quis magna Lorem anim amet ipsum do mollit sit cillum
                                                        voluptate ex nulla tempor. Laborum consequat non elit enim
                                                        exercitation cillum aliqua consequat id aliqua. Esse ex
                                                        consectetur mollit voluptate est in duis laboris ad sit
                                                        ipsum anim Lorem. Incididunt veniam velit elit elit veniam
                                                        Lorem aliqua quis ullamco deserunt sit enim elit aliqua esse
                                                        irure. Laborum nisi sit est tempor laborum mollit labore
                                                        officia laborum excepteur commodo non commodo dolor
                                                        excepteur commodo. Ipsum fugiat ex est consectetur ipsum
                                                        commodo tempor sunt in proident.</p>
                                                    <h4 id="list-item-3">Item 3</h4>
                                                    <p>Quis anim sit do amet fugiat dolor velit sit ea ea do
                                                        reprehenderit culpa duis. Nostrud aliqua ipsum fugiat minim
                                                        proident occaecat excepteur aliquip culpa aute tempor
                                                        reprehenderit. Deserunt tempor mollit elit ex pariatur
                                                        dolore velit fugiat mollit culpa irure ullamco est ex
                                                        ullamco excepteur.</p>
                                                    <h4 id="list-item-4">Item 4</h4>
                                                    <p>Quis anim sit do amet fugiat dolor velit sit ea ea do
                                                        reprehenderit culpa duis. Nostrud aliqua ipsum fugiat minim
                                                        proident occaecat excepteur aliquip culpa aute tempor
                                                        reprehenderit. Deserunt tempor mollit elit ex pariatur
                                                        dolore velit fugiat mollit culpa irure ullamco est ex
                                                        ullamco excepteur.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

                 <?php include 'layouts/footer.php'; ?>

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
            </div>

         </div>
        <!-- END wrapper -->

        <?php include 'layouts/right-sidebar.php'; ?>
        
        <?php include 'layouts/footer-scripts.php'; ?>
        
        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
    </body>
</html>