极光推送说明:

使用前要定义好密钥;
define('master_secret','');
define('app_key','');

详见极光官方文档:
http://docs.jpush.io/server/rest_api_v3_push

摘要:
1.平台识别
    JPush 当前支持 Android, iOS, Windows Phone 三个平台的推送。其关键字分别为："android", "ios", "winphone"。

2.目标识别
    推送给全部（广播）：
    {
       "platform": "all",
       "audience" : "all",
       "notification" : {
          "alert" : "Hi, JPush!",
       }
    }
    推送给多个标签（只要在任何一个标签范围内都满足）：在深圳、广州、或者北京
    {
        "audience" : {
            "tag" : [ "深圳", "广州", "北京" ]
        }
    }
    推送给多个标签（需要同时在多个标签范围内）：在深圳并且是“女”
    {
        "audience" : {
            "tag_and" : [ "深圳", "女" ]
        }
    }
    推送给多个别名：
    {
        "audience" : {
            "alias" : [ "4314", "892", "4531" ]
        }
    }
    推送给多个注册ID：
    {
        "audience" : {
            "registration_id" : [ "4312kjklfds2", "8914afd2", "45fdsa31" ]
        }
    }
3.通知样式
    {
        "notification" : {
            "ios" : {
                 "alert" : "hello, JPush!", 
                 "sound" : "happy", 
                 "badge" : 1, 
                 "extras" : {
                      "news_id" : 134, 
                      "my_key" : "a value"
                 }
            }
        }
    }
    {
        "notification" : {
            "android" : {
                 "alert" : "hello, JPush!", 
                 "title" : "JPush test", 
                 "builder_id" : 3, 
                 "extras" : {
                      "news_id" : 134, 
                      "my_key" : "a value"
                 }
            }
        }
    }
    {
        "notification" : {
            "winphone" : {
                 "alert" : "hello, JPush!", 
                 "title" : "Push Test", 
                 "_open_page" : "/friends.xaml", 
                 "extras" : {
                      "news_id" : 134, 
                      "my_key" : "a value"
                 }
            }
        }
    }



锋子[nuke.zou@corp.to8to.com]
2014年12月24日 14:56:59

