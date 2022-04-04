import { ColorPicker } from "@wordpress/components";

const ColorPickerIris = ({ onChange, value, value: { color } }) => {
	return (
		<div>
			<ColorPicker
				color={color}
				enableAlpha
				onChangeComplete={(result) => {
					if (result.rgb) {
						onChange({
							...value,
							color:
								result.rgb.a === 1
									? result.hex
									: `rgba(${result.rgb.r}, ${result.rgb.g}, ${result.rgb.b}, ${result.rgb.a})`,
						});

						return;
					}

					onChange({
						...value,
						color:
							color.getAlpha() === 1 ? hex : color.toRgbString(),
					});
				}}
			/>
		</div>
	);
};

export default ColorPickerIris;
