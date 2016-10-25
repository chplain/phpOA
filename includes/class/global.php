<?php

class includes_class_global {

    public $db;

    function __construct() {
        include_once (str_replace('class\global.php', 'Mysql.class.php', __FILE__));
        $this->db = new mysql ();
    }

    /**
     *
     * @param type $data 数据
     * @param type $name 显示数据
     * @param type $val  对应数值
     * @param type $sel  选中
     * @return string 
     */
    function toSelectOption($data, $name, $val, $sel='') {
        $res = '';
        if (is_array($data)) {
            foreach ($data as $dval) {
                $res.='<option value="' . $dval[$val] . '" ' . ($sel == $dval[$val] ? 'selected' : '') . '>' . $dval[$name] . '</option>';
            }
        }
        return $res;
    }

    /**
     *
     * @param type 类型 1 合并子公司 
     */
    function getBranchInfo($type='1') {
        if (empty($type)) {
            $type = '1';
        }
        $sql = "select * from branch_info where type='" . $type . "' order by parentid , comcard ";
        $query = $this->db->query($sql);
        $data = array();
        while (($row = $this->db->fetch_array($query)) != false) {
            $data[$row['ID']] = $row;
        }
        return $data;
    }

    /**
     * 获取部门
     * @param $dept_id
     */
    function GetDept($dept_id=null, $getdeptname=false) {
        if ($dept_id) {
            if (is_array($dept_id)) {
                $where = "where dept_id in(" . implode(',', $dept_id) . ") ";
            } else {
                $where = "where dept_id in($dept_id)";
            }
        }
        if (empty($where)) {
            $where = " where delflag='0' ";
        } else {
            $where.=" and delflag='0' ";
        }
        $query = $this->db->query("select * from department $where");
        $data = array();
        while (($rs = $this->db->fetch_array($query)) != false) {
            if ($getdeptname) {
                $data[] = $rs['DEPT_NAME'];
            } else {
                $data[] = $rs;
            }
        }
        return $data;
    }

    /**
     * 获取职位
     * @param unknown_type $jobs
     */
    function GetJobs($jobs=null, $getjobsname=false) {
        if ($jobs) {
            if (is_array($jobs)) {
                $where = "where id in(" . implode(',', $jobs) . ")";
            } else {
                $where = " where id in($jobs)";
            }
        }
        $query = $this->db->query("select * from user_jobs $where");
        $data = array();
        while (($rs = $this->db->fetch_array($query)) != false) {
            if ($getjobsname) {
                $data[] = $rs['name'];
            } else {
                $data[] = $rs;
            }
        }
        return $data;
    }

    /**
     * 获取用户
     * @param unknown_type $userid
     * @param unknown_type $getusername
     */
    function GetUser($userid, $getusername=false) {
        $where = ' where del=0 and has_left=0 ';
        if ($userid) {
            if (is_array($userid)) {
                $id_arr = array();
                foreach ($userid as $val) {
                    $id_arr[] = sprintf("'%s'", $val);
                }
                $where .= " and user_id in(" . implode(',', $id_arr) . ")";
            } else {
                $where = " and user_id in($userid)";
            }
        }
        $query = $this->db->query("select * from  user $where");
        $data = array();
        while (($rs = $this->db->fetch_array($query)) != false) {
            if ($getusername) {
                $data[] = $rs['USER_NAME'];
            } else {
                $data[] = $rs;
            }
        }
        return $data;
    }

    /**
     * 部门下拉
     * @param $dept_id
     * @param $depart_x
     */
    function depart_select($dept_id = '', $depart_x = '' , $clflag=true , $sother=false) {
        $Ts = "|　";
        $Te = "|─";
        if($sother){
            $sql="select DEPT_ID,DEPT_NAME,Depart_x,Dflag from department where ( delflag='0' or depart_x='02') order by Depart_x";
        }else{
            $sql="select DEPT_ID,DEPT_NAME,Depart_x,Dflag from department where delflag='0' order by Depart_x";
        }
        $query = $this->db->query($sql);
        while (($rs = $this->db->fetch_array($query)) != false) {
            if ($rs['DEPT_ID'] == 1 && $_SESSION['USER_ID'] != 'admin')
                continue;
            $DFLAGS = $rs["Dflag"];
            $TS = "";
            for ($d = 0; $d <= $DFLAGS; ++$d) {
                $TS .= $Ts;
            }
            if ($DFLAGS == 0) {
                $TS = "";
            }
            if ($rs['DEPT_ID'] == $dept_id) {
                $str .= '<option selected '.($clflag?'onclick="show_jobs()"':'').' value="' . $rs['DEPT_ID'] . '">' . $TS . $Te . $rs["DEPT_NAME"] . '</option>';
            } elseif ($rs['Depart_x'] == $depart_x) {
                $str .= '<option selected '.($clflag?'onclick="show_jobs()"':'').' value="' . $rs['DEPT_ID'] . '">' . $TS . $Te . $rs["DEPT_NAME"] . '</option>';
            } else {
                $str .= '<option '.($clflag?'onclick="show_jobs()"':'').' value="' . $rs['DEPT_ID'] . '">' . $TS . $Te . $rs["DEPT_NAME"] . '</option>';
            }
        }
        return $str;
    }

    /**
     * 栏目下拉
     *
     * @param unknown_type $menuid
     * @return unknown
     */
    function menu_select($menuid = '') {
        $menuarr=array();
        //顶栏目
        $query = $this->db->query("select menu_id , menu_name from sys_menu order by taxis_id");
        while (($row = $this->db->fetch_array($query)) != false) {
            $menuarr[0][$row['menu_id']]=$row['menu_name'];
        }
        //子栏目
        $query = $this->db->query("select menu_id , func_name from sys_function where enabled=1 order by menu_id");
        while (($row = $this->db->fetch_array($query)) != false) {
            $pid=substr($row['menu_id'], 0, -2);
            $menuarr[$pid][$row['menu_id']]=$row['func_name'];
        }
        $res=$this->build_options($menuarr,0,$menuid);
//        echo $res;
        return $res;
    }

    /**
     * 生成递归数据
     * @param type $data 数据源
     * @param type $key 开始递归数据
     * @param type $seach 查询数据
     * @param type $level 递归等级 0 级开始
     * @return type 
     */
    function build_options($data, $key=0, $seach=0,$level=0) {
        $grade = 0; //第一级的第几级
        $start = "|-";
        $space = "| ";
        $space = str_repeat($space, $level);
        $indent = $space . $start;
        foreach ($data[$key] as $dkey => $dval) {//第一级
            if ($seach == $dkey)
                $res .= "<option value='$dkey' selected>" .$indent. $dval . "</option>";
            else
                $res .= "<option value='$dkey' >" .$indent. $dval . "</option>";
            if (isset($data[$dkey])) {//如果有下一级
                $res .=$this->build_options($data, $dkey, $seach,$level+1);
            }
        }
        return $res;
    }

    /**
     * 显示栏目
     *
     * @param unknown_type $menuid
     * @return unknown
     */
    function showmenu($menuid) {
        if (strlen($menuid) > 4) {
            $rs = $this->db->get_one("select * from sys_menu where MENU_ID=left($menuid,2)");
            $str .= $rs['MENU_NAME'];
            $rs = $this->db->get_one("select * from sys_function where MENU_ID=left($menuid,4)");
            if ($rs) {
                $str .= ' -> <a href="?model=purview&menuid=' . $rs['MENU_ID'] . '">' . $rs['FUNC_NAME'] . '</a>';
            }
            $rs = $this->db->get_one("select * from sys_function where MENU_ID=$menuid");
            if ($rs) {
                $str .= ' -> <a href="?model=purview&menuid=' . $rs['MENU_ID'] . '">' . $rs['FUNC_NAME'] . '</a>';
            }
            return $str;
        } elseif (strlen($menuid) > 2) {
            $rs = $this->db->get_one("select * from sys_menu where MENU_ID=left($menuid,2)");
            $str .= $rs['MENU_NAME'];
            $rs = $this->db->get_one("select * from sys_function where MENU_ID=$menuid");
            if ($rs) {
                $str .= ' -> <a href="?model=purview&menuid=' . $rs['MENU_ID'] . '">' . $rs['FUNC_NAME'] . '</a>';
            }
            return $str;
        } elseif (intval($menuid)) {
            $rs = $this->db->get_one("select * from sys_menu where MENU_ID=$menuid");
            $str .= $rs['MENU_NAME'];
            return $str;
        }
    }

    /**
     * 按区域ID获取区域名称
     *
     * @param unknown_type $areaid
     * @return unknown
     */
    function get_area($areaid) {
        if (is_array($areaid)) {
            $query = $this->db->query("select id,name from area where id in(" . implode(',', $areaid) . ")");
            $data = array();
            while (($rs = $this->db->fetch_array($query)) != false) {
                $data[$rs['id']] = $rs['name'];
            }
            return $data;
        } else {
            $rs = $this->db->get_one("select name from area where id=" . $areaid);
            return $rs['name'];
        }
    }

    /**
     * 所有区域下拉
     *
     * @param string $id
     * @return unknown
     */
    function area_select($id = '') {
        $query = $this->db->query("select ID,Name from area");
        $str.='<option value="0"> </option>';//添加 空白
        while (($rs = $this->db->fetch_array($query)) != false) {
            if ($rs['ID'] == $id) {
                $str .= '<option selected value="' . $rs['ID'] . '">' . $rs['Name'] . '</option>';
            } else {
                $str .= '<option value="' . $rs['ID'] . '">' . $rs['Name'] . '</option>';
            }
        }
        return $str;
    }

    /**
     * 获取用户信息
     *
     * @param string $userid
     * @param string $find
     * @return string
     */
    function GetUserinfo($userid, $find) {
        $rs = $this->db->get_one("
			select 
				a.user_id,a.logname,a.dept_id,a.user_name,a.assistantdept,b.dept_name,b.depart_x,c.name as jobs_name,d.Name as areaname,
                d.id as areaId,e.dept_name as edept_name,e.depart_x as edepart_x ,a.logname , a.email
			from 
				user as a 
				left join department as b on b.DEPT_ID=a.DEPT_ID 
				left join department as e on e.dept_id = b.parent_id
				left join user_jobs as c on c.id=a.jobs_id 
				left join area as d on d.id=a.AREA
			where 
				a.USER_ID='$userid'
			");
        if (is_array($find)) {
            $arr = array();
            foreach ($find as $val) {
                $arr[$val] = $rs[$val];
            }
            return $arr;
        } else {
            return $rs[$find];
        }
    }

    /**
     * 获取用户名
     * @param $userid
     */
    function GetUserName($userid) {
        if (is_array($userid)) {
            $arr = array();
            foreach ($userid as $val) {
                $arr[] = sprintf("'%s'", $val);
            }
            $userid = implode(',', $arr);
        } else {
            $userid = "'$userid'";
        }

        $query = $this->db->query("select user_id,user_name from user where user_id in ($userid)");
        $data = array();
        while (($rs = $this->db->fetch_array($query)) != false) {
            $data[$rs['user_id']] = $rs['user_name'];
        }
        return $data;
    }

    /**
     * 获取邮件地址
     * @param string or array $userid
     */
    function get_email($userid) {
        if (is_array($userid)) {
            $user = array();
            foreach ($userid as $val) {
                $user[] = "'$val'";
            }
            $userid = implode(',', $user);
        } elseif ($userid) {
            $userid = "'$userid'";
        }
        $query = $this->db->query("select email from user where del=0 and has_left=0  " . ($userid ? " and user_id in($userid)" : ' and 1=0 ') . "");
        $data = array();
        while (($rs = $this->db->fetch_array($query)) != false) {
            $data[] = $rs['email'];
        }
        return $data;
    }

    /**
     * 用户访问区域
     *
     */
    function area_call($areaid) {
        if ($areaid) {
            if ($areaid == 'all') {
                $query = $this->db->query("select * from area");
            } else {
                $query = $this->db->query("select * from area where id in($areaid)");
            }
            $arr = array();
            while (($rs = $this->db->fetch_array($query)) != false) {
                $arr[] = $rs;
            }
            return $arr;
        }
    }

    /**
     * 区域checkbox列表
     *
     * @param unknown_type $arr
     * @return unknown
     */
    function area_checkbox($arr = null) {
        $query = $this->db->query("select * from area where del!=1");
        while (($rs = $this->db->fetch_array($query)) != false) {
            if ($arr && in_array($rs['ID'], $arr)) {
                $str .= ' <input type="checkbox" checked name="area[]" value="' . $rs['ID'] . '" />' . $rs['Name'];
            } else {
                $str .= ' <input type="checkbox" name="area[]" value="' . $rs['ID'] . '" />' . $rs['Name'];
            }
        }
        return $str;
    }

    /**
     * 记录日志
     *
     * @param unknown_type $type
     * @param unknown_type $obj
     * @param unknown_type $event
     * @param unknown_type $res
     * @param unknown_type $exp
     */
    function insertOperateLog($type, $obj, $event, $res, $exp = "") {
        try {
            $handler = isset($_SESSION["USER_ID"]) ? $_SESSION["USER_ID"] : "";
            $ip = $_SERVER["REMOTE_ADDR"];
            $url = urlencode($_SERVER["REQUEST_URI"]);
            $exp = addslashes($exp);
            $sql = " insert into user_operate_log (Handler,Obj,Event,DT,Url,IP,Type,Result,Exp) values ('$handler','$obj','$event',now(),'$url','$ip','$type','$res','$exp')";
            $this->db->query($sql);
        } catch (Exception $e) {
            writeToLog("用户操作记录录入失败！", "log.txt");
        }
    }

    function fetch_user_salt_je($length = 3) {
        $salt = "";
        $i = 0;
        for (; $i < $length; ++$i) {
            $salt .= chr(rand(32, 126));
        }
        return $salt;
    }

    /**
     * 生成随机字符串
     *
     * @param unknown_type $len
     * @param unknown_type $format
     * @return unknown
     */
    function randStr($len = 6, $format = 'ALL') {
        switch ($format) {
            case 'ALL' :
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                break;
            case 'CHAR' :
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-@#~';
                break;
            case 'NUMBER' :
                $chars = '0123456789';
                break;
            default :
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-@#~';
                break;
        }
        mt_srand((double) microtime() * 1000000 * getmypid());
        $password = "";
        while (strlen($password) < $len)
            $password .= substr($chars, (mt_rand() % strlen($chars)), 1);
        return $password;
    }

    /**
     * 加解密： $operation = 'DECODE' 为解密，其他任意字符为加密。
     * 
     * @param string $string
     * @param string $operation
     * @param string $key
     * @param int $expiry
     * @return string
     */
    function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {

        $ckey_length = 4;
        $key = md5($key ? $key : oa_auth_key );
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), - $ckey_length)) : '';

        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0 ) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if ($operation == 'DECODE') {
            if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc . str_replace('=', '', base64_encode($result));
        }
    }

    /**
     * 保存编辑器内容
     *
     * @return unknown
     */
    function set_fckeditor_temp_content($content) {
        return file_put_contents(EDITOR_DIR . '/' . $_SESSION['USER_ID'], $content);
    }

    function get_fckeditor_temp_content() {
        if (file_exists(EDITOR_DIR . '/' . $_SESSION['USER_ID'])) {
            return file_get_contents(EDITOR_DIR . '/' . $_SESSION['USER_ID']);
        }
    }

    /**
     * 获取授权代理人信息
     * @param <type> $user
     * @param <type> $bdt
     * @param <type> $edt
     * @return <type> 授权代理人ID
     */
    function getPowerAccredit($user, $bdt='', $edt='') {
        $powArr = array();
        if (empty($bdt)) {
            $bdt = date('Y-m-d');
        }
        if (empty($edt)) {
            $edt = date('Y-m-d');
        }
        $sql = "select
                FROM_ID
            from
                power_set
            where TO_ID='" . $user . "' and STATUS='1' 
                and BEGIN_DATE <= '" . $bdt . "' and END_DATE>='" . $edt . "'";
        $query = $this->db->query($sql);
        while ($row = $this->db->fetch_array($query)) {
            $powArr[] = $row['FROM_ID'];
        }
        return $powArr;
    }

    /*
     * 
     */

    function getTables($table) {
        $table = preg_replace("'<table[^>]*?>'si", "", $table);
        $table = preg_replace("'<tr[^>]*?>'si", "", $table);
        $table = preg_replace("'<th[^>]*?>'si", "", $table);
        $table = preg_replace("'<td[^>]*?>'si", "", $table);
        $table = str_replace("</tr>", "{tr}", $table);
        $table = str_replace("</th>", "{td}", $table);
        $table = str_replace("</td>", "{td}", $table);
//去掉 HTML 标记  
        $table = preg_replace("'<[\/\!]*?[^<>]*?>'si", "", $table);
//去掉空白字符   
        $table = preg_replace("'([\r\n])[\s]+'", "", $table);
        $table = str_replace(" ", "", $table);
        $table = str_replace(" ", "", $table);
        $table = explode('{tr}', $table);
        array_pop($table);
        foreach ($table as $key => $tr) {
            $td = explode('{td}', $tr);
            array_pop($td);
            $td_array[] = $td;
        }
        return $td_array;
    }

    /**
     *
     * @param type $tab
     * @param type $flag rep:报表引擎
     * @return type 
     */
    function getHtmlTables($tab, $flag='') {
        $tab = preg_replace("'([\r\n])[\s]+'", "", $tab);
        $tab = strstr($tab, '<tr>');
        $tab = preg_replace("'<tr[^>]*?>'si", "", $tab);
        $tab = substr($tab, 0, strripos($tab, '</tr>'));
        $tabdata = explode('</tr>', $tab);
        if ($flag == 'rep') {//报表引擎
            $tabcode = array_pop($tabdata);
        }
        if (!empty($tabdata)) {
            foreach ($tabdata as $key => $val) {
                $tabdata[$key] = explode('</th>', rtrim($val, '</th>'));
                if (!empty($tabdata[$key])) {
                    foreach ($tabdata[$key] as $vkey => $vval) {
                        $tmparr = array();
                        preg_match('/rowspan="([0-9])"/', $vval, $tmp);
                        $tmparr['rows'] = $tmp['1'];
                        preg_match('/colspan="([0-9])"/', $vval, $tmp);
                        $tmparr['cols'] = $tmp['1'];
                        $tmparr['val'] = preg_replace("'<th[^>]*?>'si", "", $vval);
                        $tabdata[$key][$vkey] = $tmparr;
                    }
                }
            }
        }
        if ($flag == 'rep') {//报表引擎
            if (!empty($tabcode)) {
                $tabcode = preg_replace("'<th[^>]*?>'si", "", $tabcode);
                $tabcode = explode('</th>', rtrim($tabcode, '</th>'));
            }
            $res = array(
                'tab' => $tabdata
                , 'code' => $tabcode
            );
        } else {
            $res = $tabdata;
        }
        return $res;
    }

    /*
      截取字符串
     */

    function cut_str($string, $sublen, $start = 0, $code = 'UTF-8', $flag=true) {
        if ($code == 'UTF-8') {
            $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
            preg_match_all($pa, $string, $t_string);

            if (count($t_string[0]) - $start > $sublen && $flag)
                return join('', array_slice($t_string[0], $start, $sublen)) . "...";
            return join('', array_slice($t_string[0], $start, $sublen));
        }
        else {
            $start = $start * 2;
            $sublen = $sublen * 2;
            $strlen = strlen($string);
            $tmpstr = '';

            for ($i = 0; $i < $strlen; $i++) {
                if ($i >= $start && $i < ($start + $sublen)) {
                    if (ord(substr($string, $i, 1)) > 129) {
                        $tmpstr.= substr($string, $i, 2);
                    } else {
                        $tmpstr.= substr($string, $i, 1);
                    }
                }
                if (ord(substr($string, $i, 1)) > 129)
                    $i++;
            }
            if (strlen($tmpstr) < $strlen && $flag)
                $tmpstr.= "...";
            return $tmpstr;
        }
    }
    //excel
    function numToCell($num){
        $cellabc = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $shang=floor($num/26);
        $yu=ceil($num%26);
        if($shang==0){
            $col=$cellabc[$yu];
        }else{
            $col=$cellabc[$shang-1].$cellabc[$yu];
        }
        return $col;
    }
    
    /**
     *获取公司信息
     * @param type $setid
     * @return string 
     */
    function get_com_sel($setid=true,$settp='all',$setidn='seacom',$title='：',$selected=''){
        $title = $title=='：'?'公司：':$title;
        if($setid==true){
            if($settp=='all'){
                $res=$title."<select id='".$setidn."'> <option value='' tabindex='所有公司'>所有公司</option>";
            }else{
                $res=$title."<select id='".$setidn."'>";
            }
        }else{
            $res='';
        }
        $comInfo=$this->getBranchInfo();
        foreach($comInfo as $key=>$val){
            if($selected==$val['NamePT']){
                $res.="<option value='".$val['NamePT']."' tabindex='".$val['NamePT']."' selected >".$val['NameCN']."</option>";
            }else{
                $res.="<option value='".$val['NamePT']."' tabindex='".$val['NamePT']."'>".$val['NameCN']."</option>";
            }
            
        }
        if($setid){
            $res.="</select>";
        }else{
            
        }
        return $res;
    }
    
    /**
     *获取部门信息
     * @param type $setid
     * @return string 
     */
    function get_dept_sel($setid=true,$settp='all',$setidn='seadept',$title='：',$selected=''){
        $title = $title=='：'?'公司：':$title;
        if($setid==true){
            if($settp=='all'){
                $res=$title."<select id='".$setidn."'> <option value='' tabindex='所有部门'>所有部门</option>";
            }else{
                $res=$title."<select id='".$setidn."'>";
            }
        }else{
            $res='';
        }
        $res.=$this->depart_select($selected,$selected,0,1);
        if($setid){
            $res.="</select>";
        }else{
            
        }
        return $res;
    }
    /**
     * 
     */
    function json_tree_data($treearr,$id='0'){
        $res='';
        $rea='';
        if(!empty($treearr[$id])){
            foreach($treearr[$id] as $key=>$val){
                if(!empty($treearr[$key])){
                    $val=un_iconv($val);
                    $val['id']=$key;
                    $val['text']=$val['name'];
                    $val['iconCls']='';
                    $val['state']='';
                    $val['children']=$this->json_tree_data($treearr,$key);
                    $rea[]=$val;
                }else{
                    $val['id']=$key;
                    $val['text']=$val['name'];
                    $val['iconCls']='';
                    $val['state']=$val['state'];
                    $rea[]=un_iconv($val);
                }
            }
        }
        return $rea;
    }
    
    /**
     *读取工资数据
     * @param type $seapy 查询年度格式：“2013”，“-”代表不限年限。
     * @param type $seapm 查询月份格式：“1”，“-”代表不限月份。
     * @param type $seadept 查询部门ID，默认不限制部门。
     * @return array('年月'=>array('员工号'=>array('paycost'=>'人工成本=总工资+公司公积金+公司社保费+管理费')))  
     */
    function get_salary_info($seapy,$seapm,$seadept='-'){
        $res=array();
        $m=$_REQUEST['model'];
        $c=$_REQUEST['action'];
        $ck=array(
            'engineering_person_esmperson'=>array(
                'updateSalary'
            )
        );
        if(in_array($c, $ck[$m])){
            $sql="select value from config where type='salary' and name='".$m."' ";
            $priarr=$this->db->get_one($sql);
            $prikey=crypt_util($priarr['value'], 'decode', $m);
            $salaryClass = new model_salary_util();
            $salaryClass->set_prikey($salaryClass->configCrypt($prikey));
            $salaryClass->set_rsakey();
            $comsql='';
            if($seapy!='-'){
                $comsql.=" and p.pyear='".$seapy."' ";
            }
            if($seapm!='-'){
                $comsql.=" and p.pmon='".$seapm."' ";
            }
            if($seadept!='-'){
                $comsql.=" and p.deptid='".$seadept."' ";
            }
            $sql="select * from ( (select     
                                 p.gjjam , p.shbam
                                , p.remark , p.baseam , p.floatam , p.proam , p.otheram
                                , p.bonusam , p.othdelam , p.perholsdays , p.sickholsdays , p.paycesse , p.paytotal , p.sperewam ,p.spedelam
                                , p.pyear , p.pmon
                                , p.sdyam , p.cessebase , p.id 
                                , p.cogjjam , p.coshbam , p.prepaream , p.handicapam , p.manageam
                                , p.userid ,p.leaveflag , p.totalam , p.accrewam , p.accdelam , p.expflag , p.deptid , p.holsdelam
                                 , p.nowamflag  , p.comflag , p.usercom
                                 from salary_pay p 
                                 where   p.leaveflag=0 and ( (p.nowamflag!=3 and p.nowamflag!=4) or p.nowamflag is null ) ".$comsql."
                ) order by userid , pyear , pmon , leaveflag ) p ";
            $query=$this->db->query($sql);
            if($m=='engineering_person_esmperson'){
                while ($row = $this->db->fetch_array($query)) {
                    $total=$salaryClass->decryptDeal($row['totalam']);//工资总额（不含社保公积金）
                    $coshb=$salaryClass->decryptDeal($row['coshbam']);//公司社保费
                    $cogjj=$salaryClass->decryptDeal($row['cogjjam']);//公司公积金
                    //$man=$salaryClass->decryptDeal($row['manageam']);//管理费
                    $res[$row['pyear'].sprintf("%02s",$row['pmon'])][$row['userid']]=array(
                        'dept'=>$row['deptid']
                        ,'tol'=>$total
                        ,'coshb'=>$coshb
                        ,'cogjj'=>$cogjj
                        //人员工资成本
                        ,'paycost'=>round(($total+$coshb+$cogjj), 4)
                    );
                }
            }
        }else{
            $res['error']='数据读取失败';
        }
        //$res['error']='数据读取失败'.json_encode($res).$_REQUEST['action'].$sql;
        return $res;
    }
    
    

function num2Upper($num, $type = 'trim')
{
    
    $UpperNum = array("0"=>"零","1"=>"壹","2"=>"贰","3"=>"叁","4"=>"肆","5"=>"伍","6"=>"陆","7"=>"柒","8"=>"捌","9"=>"玖");
    $num=trim($num);
    $num=round($num,2);
    $length=strlen($num);
    if($length==0)
        return;
    $retstr=false;

    $numarrs=explode(".", $num);
    $numarr = str_split($numarrs[0]);
    switch(count($numarr))
    {
        case 1:
            $retstr = $UpperNum[$numarr[0]];
            break;
        case 2:
            $retstr = $UpperNum[$numarr[0]]." 拾 ".$UpperNum[$numarr[1]];
            break;
        case 3:
            $retstr = $UpperNum[$numarr[0]]." 佰 ".$UpperNum[$numarr[1]]." 拾 ".$UpperNum[$numarr[2]];
            break;
        case 4:
            $retstr = $UpperNum[$numarr[0]]." 仟 ".$UpperNum[$numarr[1]]." 佰 ".$UpperNum[$numarr[2]]." 拾 ".$UpperNum[$numarr[3]];
            break;
        case 5:
            $retstr = $UpperNum[$numarr[0]]." 万 ".$UpperNum[$numarr[1]]." 仟 ".$UpperNum[$numarr[2]]." 佰 ".$UpperNum[$numarr[3]]." 拾 ".$UpperNum[$numarr[4]];
            break;
        case 6:
            $retstr = $UpperNum[$numarr[0]]." 拾 ".$UpperNum[$numarr[1]]." 万 ".$UpperNum[$numarr[2]]." 仟 ".$UpperNum[$numarr[3]]." 佰 ".$UpperNum[$numarr[4]]." 拾 ".$UpperNum[$numarr[5]];
            break;
        case 7:
            $retstr = $UpperNum[$numarr[0]]." 佰 ".$UpperNum[$numarr[1]]." 拾 ".$UpperNum[$numarr[2]]." 万 ".$UpperNum[$numarr[3]]." 仟 ".$UpperNum[$numarr[4]]." 佰 ".$UpperNum[$numarr[5]]." 拾 ".$UpperNum[$numarr[6]];
            break;
        case 8:
            $retstr = $UpperNum[$numarr[0]]." 仟 ".$UpperNum[$numarr[1]]." 佰 ".$UpperNum[$numarr[2]]." 拾 ".$UpperNum[$numarr[3]]." 万 ".$UpperNum[$numarr[4]]." 仟 ".$UpperNum[$numarr[5]]." 佰 ".$UpperNum[$numarr[6]]." 拾 ".$UpperNum[$numarr[7]];
            break;
        default:
            $retstr="";
            break;
            
    };
    $retstr = "￥".$retstr." 元";
    if(count($numarrs)==2)
    {
        $numarr = str_split($numarrs[1]);
        switch(count($numarr))
        {
            case 1:
                $retstr .= " ".$UpperNum[$numarr[0]]." 角 零 分";
                break;
            case 2:
                $retstr .= " ".$UpperNum[$numarr[0]]." 角 ".$UpperNum[$numarr[1]]." 分";
                break;
            default:
                $retstr.="";
                break;
        };       
    }else
    $retstr = $retstr."整";
    
    if($type=='trim'){
      $retstr = str_replace(" ","",$retstr);
    }
    
    return $retstr;
}

// 定义一个函数getIP()
    function getIP() {
        if (getenv("HTTP_CLIENT_IP"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR"))
            $ip = getenv("REMOTE_ADDR");
        else
            $ip = "Unknow";
        return $ip;
    }

}

?>