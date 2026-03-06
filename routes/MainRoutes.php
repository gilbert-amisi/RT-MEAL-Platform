<?php
class MainRoutes
{

    private $render;
    private $sub;
    private $op;

    public function __construct()
    {
    }

    public static function myWay($myRender, $mySub , $myOp, $reponse, $fromHome, $link, $fromController, $fromIndex)
    {
        if (!$link) {
            if ($fromHome)
                return header('Location:home.php?render=' . sha1($myRender) . '&sub=' . sha1($mySub) . '&op=' . sha1($myOp));

            if ($fromController)
                return header('Location:../../views/home.php?render=' . sha1($myRender) . '&sub=' . sha1($mySub) . '&op=' . sha1($myOp) . '&reponse=' . sha1($reponse));

            if ($fromIndex)
                return header('Location:views/home.php?render=' . sha1($myRender) . '&sub=' . sha1($mySub) . '&op=' . sha1($myOp));

        } else {
            return 'home.php?render=' . sha1($myRender) . '&sub=' . sha1($mySub) . '&op=' . sha1($myOp) . '&reponse=' . sha1($reponse);
        }
    }
}
