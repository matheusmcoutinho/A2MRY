using Microsoft.AspNetCore.Mvc;
using ClinicaEsteticaApi.Models;

namespace ClinicaEsteticaApi.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class AuthController : ControllerBase
    {
        private readonly List<UserLoginModel> usuariosValidos = new List<UserLoginModel>
        {
            new UserLoginModel { Email = "rodrigo@gmail.com", Senha = "rodriguinhoReiDelas" },
            new UserLoginModel { Email = "BRUNIN@gmail.com", Senha = "DAGARELA" }
        };

        [HttpPost("login")]
        public IActionResult Login([FromBody] UserLoginModel loginModel)
        {
            var usuario = usuariosValidos.FirstOrDefault(u => u.Email == loginModel.Email && u.Senha == loginModel.Senha);
            if (usuario != null)
            {
                return Ok(new { message = "Login bem-sucedido!" });
            }
            return Unauthorized(new { message = "Credenciais inválidas." });
        }
    }
}
