import { NestFactory } from '@nestjs/core';
import { AppModule } from './app/app.module';
import { Logger } from '@nestjs/common';

async function bootstrap() {
  const logger = new Logger('links-grabber-logger');
  const PORT = 3000;
  const app = await NestFactory.create(AppModule);
  await app.listen(PORT);
  logger.verbose(`✩✩✩ Api is running in http://localhost:${PORT}`);
}
bootstrap();
