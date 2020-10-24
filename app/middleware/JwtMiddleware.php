<?php
declare (strict_types = 1);

namespace app\middleware;

use app\admin\controller\Base;
use app\Code;
use Exception;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use jwt\Jwt;

class JwtMiddleware
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return \think\response\Json
     */
    public function handle($request, \Closure $next)
    {
        //
        //
        $jwt = $request->header("Admin-Token");
        if (!$jwt){
            return (new Base())->ajaxReturn(Code::JWT_ERROR,'缺少token');
        }
        try {
            $decoded = Jwt::decodedToken($jwt);
            $request->admin = $decoded;
        }catch (SignatureInvalidException $e){
            return (new Base())->ajaxReturn(Code::JWT_ERROR,"token错误");
        }catch (BeforeValidException $e){
            return (new Base())->ajaxReturn(Code::JWT_ERROR,"token未生效");
        }catch (ExpiredException $e){
            return (new Base())->ajaxReturn(Code::JWT_ERROR,"token过期");
        }catch (Exception $e){
            return (new Base())->ajaxReturn(Code::JWT_ERROR,'token解析出错');
        }
        return $next($request);
    }
}
