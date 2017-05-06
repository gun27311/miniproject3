 <nav class="navbar navbar-inverse" >
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Basic Topnav</a></li>
                <li><a href="#">เพิ่มคำสั่ง</a></li>
                <li><a href="#"></a></li>
                <li><a href="#">Page 3</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                <div class="dropdown">
                    <button  style='margin-top:9;margin-right:4px;' class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">เลือกการค้นหา
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                    <li><a href="#">ค้นหาตามคำสั่ง</a></li>
                    <li><a href="#">ค้นหาตามรายชื่อกรรมการ</a></li>
                    </ul>
                </div>
                </li>
                <li><input style='margin-top:9;' placeholder='ใส่ข้อความเพื่อค้นหา' ng-model='myfilter' class="form-control" type=text id=search></li>
                <li style=''><a href="#"><span class="glyphicon glyphicon-search"></span>ค้นหาขั้นสูง</a></li>
                
            </ul>
        </nav>