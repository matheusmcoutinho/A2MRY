using Microsoft.AspNetCore.Mvc;
using ClinicaEsteticaApi.Models;

namespace ClinicaEsteticaApi.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class ContactController : ControllerBase
    {
        [HttpPost("enviar-mensagem")]
        public IActionResult EnviarMensagem([FromBody] ContactModel contato)
        {
            if (ModelState.IsValid)
            {
                // Lógica para enviar email ou salvar mensagem
                return Ok("Mensagem enviada com sucesso!");
            }
            return BadRequest("Dados inválidos.");
        }

        [HttpPost("agendar")]
        public IActionResult Agendar([FromBody] AgendamentoModel agendamento)
        {
            if (ModelState.IsValid)
            {
                // Lógica para salvar agendamento
                return Ok("Agendamento realizado com sucesso!");
            }
            return BadRequest("Dados inválidos.");
        }
    }
}
