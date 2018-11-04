# 前后端对接文档
### 总体说明
- 若无特殊说明，前后端交互数据类型`content-type`均用`application/json`，请求方法`method`均用`POST`。
- 前端应在相应的时间阻止某些请求的发送，并给出相应的提示。
- 爱心轨迹的关键数据详见[爱心匹配数据采集方案](heart-match.md)。
- 大学城高校代码映射列表：
    <table>
        <thead>
            <tr>
                <th>学校代码</th>
                <th>学校名称</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>0</td><td>华南理工大学</td></tr>
            <tr><td>1</td><td>广东药科大学</td></tr>
            <tr><td>2</td><td>广东工业大学</td></tr>
            <tr><td>3</td><td>广州中医药大学</td></tr>
            <tr><td>4</td><td>广东外语外贸大学</td></tr>
            <tr><td>5</td><td>广州美术学院</td></tr>
            <tr><td>6</td><td>华南师范大学</td></tr>
            <tr><td>7</td><td>星海音乐学院</td></tr>
            <tr><td>8</td><td>中山大学</td></tr>
            <tr><td>9</td><td>广州大学</td></tr>
        </tbody>
    </table>
- 年级代码映射表：
    <table>
        <thead>
            <tr>
                <th>年级代码</th>
                <th>年级名称</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>1</td><td>大一</td></tr>
            <tr><td>2</td><td>大二</td></tr>
            <tr><td>3</td><td>大三</td></tr>
            <tr><td>4</td><td>大四或以上</td></tr>
            <tr><td>5</td><td>研一</td></tr>
            <tr><td>6</td><td>研二</td></tr>
            <tr><td>7</td><td>研三</td></tr>
        </tbody>
    </table>
- 电影类型代码映射表：
    <table>
        <thead>
            <tr>
                <th>类型代码</th>
                <th>类型名称</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>0</td><td>动画</td></tr>
            <tr><td>1</td><td>恐怖</td></tr>
            <tr><td>2</td><td>科幻动作</td></tr>
            <tr><td>3</td><td>爱情</td></tr>
            <tr><td>4</td><td>剧情</td></tr>
        </tbody>
    </table>
### 初始化（检测是否已微信登录、完善信息并完成题目）
- 前端示例：[2018时光胶囊的`checkLogin()`](https://github.com/651291702/bbt_timecapsule/blob/master/js/beforeLoad.js)
- 请求路径：`api/init`
- 返回参数：
    - 示例
        ```json
        {
            "errno": 0,
            "errmsg": "",
            "status": 1,
            "login": true,
            "reg": true
        }
        ```
    - 说明
        <table>
            <thead>
                <tr>
                    <th>参数名称</th>
                    <th>参数类型</th>
                    <th>参数说明</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>errno</td>
                    <td>int</td>
                    <td>错误码。0代表正常，非0代表意外错误。</td>
                </tr>
                <tr>
                    <td>errmsg</td>
                    <td>string</td>
                    <td>错误信息。</td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>int</td>
                    <td>状态码。0表示第一次数据采集期间；1表示第一次数据匹配期间；2表示第一次结果公示及第二次数据采集期间；3表示第二次数据匹配期间；4表示第二次结果公示期间；5表示活动已过期，不允许用户操作。</td>
                </tr>
                <tr>
                    <td>login</td>
                    <td>bool</td>
                    <td>是否已微信登录。</td>
                </tr>
                <tr>
                    <td>reg</td>
                    <td>bool</td>
                    <td>是否已完善报名信息并完成题目。</td>
                </tr>
            </tbody>
        </table>
### 报名
- 请求路径：`api/register`
- 请求参数：
    - 示例：
        ```json
        {
            "gender": 1,
            "name": "张三",
            "age": 20,
            "grade": 2,
            "college": 0,
            "school": "设计学院",
            "tel": "13113113331",
            "wechat": "wxid_jI4hDbE0c67Vl",
            "tagender": 0,
            "movie": 2,
            "points": {},
            "imgdata": "data:image/png;base64,..."
        }
        ```
    - 说明
        <table>
            <thead>
                <tr>
                    <th>参数名称</th>
                    <th>参数类型</th>
                    <th>参数说明</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>gender</td>
                    <td>int</td>
                    <td>性别。必填。0表示女，1表示男。</td>
                </tr>
                <tr>
                    <td>name</td>
                    <td>string</td>
                    <td>姓名。必填。1<=name.length<=25。</td>
                </tr>
                <tr>
                    <td>age</td>
                    <td>int</td>
                    <td>年龄。必填。0<=age<=200。</td>
                </tr>
                <tr>
                    <td>grade</td>
                    <td>int</td>
                    <td>年级代码。必填。1<=grade<=7。</td>
                </tr>
                <tr>
                    <td>college</td>
                    <td>int</td>
                    <td>大学城高校代码。必填。0<=college<=9</td>
                </tr>
                <tr>
                    <td>school</td>
                    <td>string</td>
                    <td>学院名称。必填。1<=school.length<=40。</td>
                </tr>
                <tr>
                    <td>tel</td>
                    <td>string</td>
                    <td>手机号码。必填。格式为/^1\d{10}$/。</td>
                </tr>
                <tr>
                    <td>wechat</td>
                    <td>string</td>
                    <td>微信号。选填。格式为/^[a-z][\w\-]{5,19}$/i。</td>
                </tr>
                <tr>
                    <td>tagender</td>
                    <td>int</td>
                    <td>匹配对方性别。0表示女，1表示男。</td>
                </tr>
                <tr>
                    <td>movie</td>
                    <td>int</td>
                    <td>电影类型代码。0<=movie<=4。</td>
                </tr>
                <tr>
                    <td>points</td>
                    <td>object</td>
                    <td>爱心形状关键数据。</td>
                </tr>
                <tr>
                    <td>imgdata</td>
                    <td>string</td>
                    <td>对画有一半爱心的canvas对象调用toDataURL()方法生成的字符串，格式为.png。</td>
                </tr>
            </tbody>
        </table>
- 返回参数：
    - 示例
        ```json
        {
            "errno": 0,
            "errmsg": ""
        }
        ```
    - 说明
        <table>
            <thead>
                <tr>
                    <th>参数名称</th>
                    <th>参数类型</th>
                    <th>参数说明</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>errno</td>
                    <td>int</td>
                    <td>错误码。0代表正常，非0代表意外错误。</td>
                </tr>
                <tr>
                    <td>errmsg</td>
                    <td>string</td>
                    <td>错误信息。</td>
                </tr>
            </tbody>
        </table>
### 查询
- 请求路径：`api/query`
- 返回参数：
    - 示例
        ```json
        {
            "errno": 0,
            "errmsg": "",
            "self": {
                "movie": 2,
                "psw": "sF5j0U"
            },
            "status": 0,
            "ta": {
                "name": "李四",
                "age": 19,
                "grade": 2,
                "college": 0,
                "school": "计算机科学与工程学院",
                "tel": "13115113331",
                "wechat": "wxid_jIsGlo8D6E4pO"
            }
        }
        ```
    - 说明
        <table>
            <thead>
                <tr>
                    <th>参数名称</th>
                    <th>参数类型</th>
                    <th>参数说明</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>errno</td>
                    <td>int</td>
                    <td>错误码。0代表正常，非0代表意外错误。</td>
                </tr>
                <tr>
                    <td>errmsg</td>
                    <td>string</td>
                    <td>错误信息。</td>
                </tr>
                <tr>
                    <td>movie</td>
                    <td>int</td>
                    <td>电影类型代码。</td>
                </tr>
                <tr>
                    <td>psw</td>
                    <td>string</td>
                    <td>取消配对密码。</td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>int</td>
                    <td>匹配状态。0表示匹配成功；1表示匹配失败；2表示匹配正在进行。</td>
                </tr>
                <tr>
                    <td>ta</td>
                    <td>object或null</td>
                    <td>当匹配成功时，类型为object，表示匹配对方的信息；否则类型为null。</td>
                </tr>
                <tr>
                    <td>name</td>
                    <td>string</td>
                    <td>姓名。</td>
                </tr>
                <tr>
                    <td>age</td>
                    <td>int</td>
                    <td>年龄。</td>
                </tr>
                <tr>
                    <td>grade</td>
                    <td>int</td>
                    <td>年级代码。</td>
                </tr>
                <tr>
                    <td>college</td>
                    <td>int</td>
                    <td>大学城高校代码。</td>
                </tr>
                <tr>
                    <td>school</td>
                    <td>string</td>
                    <td>学院名称。</td>
                </tr>
                <tr>
                    <td>tel</td>
                    <td>string</td>
                    <td>手机号码。</td>
                </tr>
                <tr>
                    <td>wechat</td>
                    <td>string或null</td>
                    <td>微信号。用户未填时值为null。</td>
                </tr>
            </tbody>
        </table>
### 获取自己的图片
- 请求路径：`api/image/self`
- 请求方法：`GET`
### 获取匹配对方的图片
- 请求路径：`api/image/ta`
- 请求方法：`GET`
### 取消第一次匹配
- 请求路径：`api/cancel`
- 请求参数：
    - 示例
        ```json
        {
            "psw": "c6US9i"
        }
        ```
    - 说明
        <table>
            <thead>
                <tr>
                    <th>参数名称</th>
                    <th>参数类型</th>
                    <th>参数说明</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>psw</td>
                    <td>string</td>
                    <td>取消配对密码。</td>
                </tr>
            </tbody>
        </table>
- 返回参数：
    - 示例
        ```json
        {
            "errno": 0,
            "errmsg": ""
        }
        ```
    - 说明
        <table>
            <thead>
                <tr>
                    <th>参数名称</th>
                    <th>参数类型</th>
                    <th>参数说明</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>errno</td>
                    <td>int</td>
                    <td>错误码。0代表正常，非0代表意外错误。</td>
                </tr>
                <tr>
                    <td>errmsg</td>
                    <td>string</td>
                    <td>错误信息。</td>
                </tr>
            </tbody>
        </table>
### 第二次匹配
- 请求路径：`api/second`
- 请求参数：
    - 示例：
        ```json
        {
            "movie": 2
        }
        ```
    - 说明
        <table>
            <thead>
                <tr>
                    <th>参数名称</th>
                    <th>参数类型</th>
                    <th>参数说明</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>movie</td>
                    <td>int</td>
                    <td>电影类型代码。0<=movie<=4。</td>
                </tr>
            </tbody>
        </table>
- 返回参数：
    - 示例
        ```json
        {
            "errno": 0,
            "errmsg": ""
        }
        ```
    - 说明
        <table>
            <thead>
                <tr>
                    <th>参数名称</th>
                    <th>参数类型</th>
                    <th>参数说明</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>errno</td>
                    <td>int</td>
                    <td>错误码。0代表正常，非0代表意外错误。</td>
                </tr>
                <tr>
                    <td>errmsg</td>
                    <td>string</td>
                    <td>错误信息。</td>
                </tr>
            </tbody>
        </table>