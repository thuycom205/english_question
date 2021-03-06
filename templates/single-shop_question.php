
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script src="https://code.createjs.com/easeljs-0.8.2.min.js"></script>
    <script src="http://localhost/woomodule/fue/wp-content/plugins/woocommerce-learn/assets/CanvasInput.js"></script>
    <script id="editable">
        (function() {

            function Button(label, color) {
                this.Container_constructor();

                this.color = color;
                this.label = label;

                this.setup();
            }
            var p = createjs.extend(Button, createjs.Container);


            p.setup = function() {
                var text = new createjs.Text(this.label, "20px Arial", "#000");
                text.textBaseline = "top";
                text.textAlign = "center";

                var width = text.getMeasuredWidth()+30;
                var height = text.getMeasuredHeight()+20;

                text.x = width/2;
                text.y = 10;

                var background = new createjs.Shape();
                background.graphics.beginFill(this.color).drawRoundRect(0,0,width,height,10);

                this.addChild(background, text);
                this.on("click", this.handleClick);
                this.on("rollover", this.handleRollOver);
                this.on("rollout", this.handleRollOver);
                this.cursor = "pointer";

                this.mouseChildren = false;

                this.offset = Math.random()*10;
                this.count = 0;
            } ;

            p.handleClick = function (event) {
                alert("You clicked on a button: "+this.label);
            } ;

            p.handleRollOver = function(event) {
                this.alpha = event.type == "rollover" ? 0.4 : 1;
            };

            window.Button = createjs.promote(Button, "Container");
        }());

        function init() {
            var stage = new createjs.Stage("demoCanvas");
            var input = new CanvasInput({
                canvas: document.getElementById('demoCanvas'),
                fontSize: 18,
                fontFamily: 'Arial',
                fontColor: '#212121',
                fontWeight: 'bold',
                width: 300,
                padding: 8,
                borderWidth: 1,
                borderColor: '#000',
                borderRadius: 3,
                boxShadow: '1px 1px 0px #fff',
                innerShadow: '0px 0px 5px rgba(0, 0, 0, 0.5)',
                placeHolder: 'Enter message here...',
                x:900,
                y:300
            });

            input.onsubmit(function() {
                var cautraloi = input._value;
                console.log(cautraloi);

                var value = input.value;
                console.log(value);
            });
            var circle = new createjs.Shape();
            circle.graphics.beginFill("LightSkyBlue").drawCircle(0, 0, 50);
            circle.x = 100;
            circle.y = 100;
            // circle.text = "Lost";
            //  stage.addChild(circle);
            var image = new Image();
            image.src = "s1.png";
            var container = new createjs.Container();
            stage.addChild(container);

            var bitmap = new createjs.Bitmap(image);

            bitmap.x =100;

            bitmap.y= 100;

            // bitmap.rotation = 360 * Math.random() | 0;
            bitmap.regX = bitmap.image.width / 2 | 0;
            bitmap.regY = bitmap.image.height / 2 | 0;
            bitmap.scaleX = bitmap.scaleY = bitmap.scale = Math.random() * 0.4 + 0.6;
            bitmap.name = "bmp_" + i;
            bitmap.cursor = "pointer";
            container.addChild(bitmap);


            var background = new createjs.Shape();
            background.name = "background";
            background.graphics.beginFill("LightSkyBlue").drawRoundRect(0, 0, 150, 60, 10);

            var label = new createjs.Text("Lost", "bold 24px Arial", "#FFFFFF");
            label.name = "label";
            label.textAlign = "center";
            label.textBaseline = "middle";
            label.x = 50;
            label.y = 60/2;

            var button = new Button("Lost!", "#F00")

            button.name = "button";
            button.x = 70;
            button.y = 90;
            button.addChild(background, label);
            // button.set({dung:true});
            button.dung = true;
            // circle.addChild(label);
            stage.addChild(button);
            var background1 = new createjs.Shape();
            background1.name = "background";
            background1.graphics.beginFill("red").drawRoundRect(0, 0, 150, 60, 10);

            var label1 = new createjs.Text("Bị mất", "bold 24px Arial", "#FFFFFF");
            label1.name = "label";
            label1.textAlign = "center";
            label1.textBaseline = "middle";
            label1.x = 150/2;
            label1.y = 60/2;

            var button1 = new createjs.Container();
            button1.name = "button";
            button1.x = 30;
            button1.y = 10;

            button1.dung = 'chinh xac';
            button1.addChild(background1, label1);
            // circle.addChild(label);
            stage.addChild(button1);

            // set up listeners for all display objects, for both the non-capture (bubble / target) and capture phases:
            var targets = [button,button1];
            for (var i=0; i<targets.length; i++) {
                var target = targets[i];
                // target.on("click", handleClick, null, false, null, false);
                //target.on("click", handleClick, null, false, null, true);
                //target.addEventListener("click", handleClick, false);
                //target.addEventListener("click", handleClick, true);

                target.on("pressmove",function(evt) {
                    // currentTarget will be the container that the event listener was added to:
                    evt.currentTarget.x = evt.stageX;
                    evt.currentTarget.y = evt.stageY;
                    // make sure to redraw the stage to show the change:
                    stage.update();
                });

                target.on("pressup", function(evt) {
                    alert("well done");
                    console.log(evt.target.dung);
                    console.log(evt.target);
                    console.log(evt.stageX);
                    console.log(evt.stageY);
                    console.log(evt);

                })
            }

            function handleClick(evt) {
                if (evt.currentTarget == stage && evt.eventPhase == 1) {
                    // this is the first dispatch in the event life cycle, clear the output.
                    // output.text = "target : eventPhase : currentTarget\n";
                }

                alert('click nut');
                console.log('click button');
                // output.text += evt.target.name+" : "+evt.eventPhase+" : "+evt.currentTarget.name+"\n";

                if (evt.currentTarget == stage && evt.eventPhase == 3) {
                    // this is the last dispatch in the event life cycle, render the stage.
                    stage.update();
                }
            }
            stage.update();
        }
    </script>


</head>
<body  onload="init();">
<style>
    #main {

    }
</style>
<div id="canvas">
    <div class="container">
        <a class="entry-icon">
            <span class="video-section"> </span>
            <span class="label">Video</span>
        </a>

        <a class="entry-icon">
            <span class="video-section"> </span>
            <span class="label">Learn</span>
        </a>

        <a class="entry-icon">
            <span class="video-section"> </span>
            <span class="label">Sentence</span>
        </a>
        <a class="entry-icon">
            <span class="video-section"> </span>
            <span class="label">Spell</span>
        </a>

        <a class="entry-icon">
            <span class="video-section"> </span>
            <span class="label">Listen</span>
        </a>
    </div>
    <canvas id="demoCanvas" width="1800" height="1500">
        <div id="main" >

        </div>
        <div id="sub">

        </div>
    </canvas>

</div>
</body>
</html>