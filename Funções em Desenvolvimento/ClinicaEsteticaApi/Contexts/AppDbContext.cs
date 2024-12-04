namespace ClinicaEsteticaApi.Contexts
{
    using Microsoft.EntityFrameworkCore;

    public class AppDbContext : DbContext
    {
        public AppDbContext(DbContextOptions<AppDbContext> options) : base(options) { }

        // Defina suas tabelas como DbSet
        public DbSet<Entidade> Entidades { get; set; }
    }
}
